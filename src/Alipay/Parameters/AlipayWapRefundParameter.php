<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 9:07
 */

namespace Payment\Alipay\Parameters;

use Payment\Exceptions\PaymentException;
use Payment\Parameters\RefundParameter;
use Payment\Support\Traits\AlipayWapParameterTrait;

/**
 * 即时到账有密退款接口
 *
 * Class AlipayWapRefundParameter
 * @package Payment\Alipay\Parameters
 * @property string $seller_email
 * @property string $seller_user_id
 * @property string $refund_date
 * @property string $batch_no
 * @property int $batch_num
 * @property string $detail_data
 */
class AlipayWapRefundParameter extends RefundParameter
{
    use AlipayWapParameterTrait;

    protected $rsa_private_path = '';

    protected $parameters = array(
        'service' => 'refund_fastpay_by_platform_pwd',
        '_input_charset'    => 'UTF-8',
        'sign_type'         => 'MD5',
        'seller_email'      => null,
        'seller_user_id'    => null,
        'refund_date'       => null,
        'batch_no'          => null,
        'batch_num'         => 0,
        'detail_data'       => array()
    );

    public function __construct($partner)
    {
        $this->parameters['partner'] = $partner;
        $this->setRefundDate(date('Y-m-d H:i:s'));

        parent::__construct($partner);
    }

    protected function buildData()
    {
        $params = array();

        foreach ($this->parameters as $key=>$value){
            if($key == 'sign' || $key == 'sign_type' || $value == '' || $value == null){
                continue;
            }
            if($key == 'detail_data'){
                $buffer = '';
                $count = 0;

                foreach ($value as $k=>$v){
                    // 检查金额是否正确。不能小于0.01
                    if (bccomp($v['total_fee'], '0.01', 2) === -1) {
                        throw new PaymentException("total_fee 交易号为{$k}的数据，交易金额小于0.01");
                    }

                    // 过滤理由中的敏感字符
                    $reason = str_replace(['^','|','#','$'], ['','','',''], $v['reason']);

                    if(empty($reason) || mb_strlen($reason) > 256){
                        throw new PaymentException("reason 交易号为{$k}的数据，退款理由为空或者长度超过256");
                    }

                    $trade_no = trim($v['trade_no'].'');
                    if(mb_strlen($trade_no) < 16 || mb_strlen($trade_no) > 64){
                        throw new PaymentException('淘宝交易号必须在16-64位之间');
                    }

                    $buffer = "{$buffer}#{$trade_no}^{$v['total_fee']}^{$reason}";

                    $count ++;
                }

                $params['detail_data'] = trim($buffer,'#');
                $params['batch_num'] = $count;
                continue;
            }
            if($key == 'batch_no'){
                $params['batch_no'] = date('Ymd') . $this->getBatchNo();
                continue;
            }
            $params[$key] = $value;
        }

        $this->requestData = $params;

    }

    protected function checkDataParams()
    {
        if(!isset($this->parameters['partner']) || $this->parameters['partner'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 partner');
        }
        if($this->getSignType() == 'MD5' && (!isset($this->parameters['key']) || $this->parameters['key'] === null)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 key');
        }
        if($this->getSignType() == 'RSA' && (empty($this->getRsaPrivatePath()) || !file_exists($this->getRsaPrivatePath()))){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 rsa_private_path');
        }
        if(empty($this->getSellerEmail()) && empty($this->getSellerUserId())){
            throw new PaymentException('提交被扫支付API接口中，seller_email和seller_user_id 两者必选其一');
        }

        if(empty($this->getRefundDate())){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 refund_date');
        }
        if(empty($this->getBatchNo())){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 batch_no');
        }
        if(empty($this->getBatchNum())){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 batch_num');
        }
        if(empty($this->getDetailData())){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 detail_data');
        }
    }

    /**
     * 卖家支付宝账号
     *
     * @return string
     */
    public function getSellerEmail()
    {
        return $this->parameters['seller_email'];
    }

    /**
     * 卖家支付宝账号
     * @param string $seller_email 是支付宝登录账号，格式一般是邮箱或手机号。
     * @return $this
     */
    public function setSellerEmail($seller_email)
    {
        $this->parameters['seller_email'] = $seller_email;
        return $this;
    }

    /**
     * 卖家用户ID
     *
     * @return string
     */
    public function getSellerUserId()
    {
        return $this->parameters['seller_user_id'];
    }

    /**
     * 卖家用户ID
     * @param string $seller_user_id seller_user_id是以2088开头的纯16位数字。
     * @return $this
     */
    public function setSellerUserId($seller_user_id)
    {
        $this->parameters['seller_user_id'] = $seller_user_id;
        return $this;
    }

    /**
     * 退款请求的当前时间。
     * 格式为：yyyy-MM-dd HH:mm:ss
     * @return string
     */
    public function getRefundDate()
    {
        return $this->parameters['refund_date'];
    }

    /**
     * 退款请求的当前时间。
     * 格式为：yyyy-MM-dd HH:mm:ss
     * @param string $refund_date
     * @return $this
     */
    public function setRefundDate($refund_date)
    {
        $this->parameters['refund_date'] = $refund_date;
        return $this;
    }

    /**
     * 退款批次号
     *
     * 每进行一次即时到账批量退款，都需要提供一个批次号，通过该批次号可以查询这一批次的退款交易记录，对于每一个合作伙伴，传递的每一个批次号都必须保证唯一性。
     * 格式为：退款日期（8位）+流水号（3～24位）。
     * 不可重复，且退款日期必须是当天日期。流水号可以接受数字或英文字符，建议使用数字，但不可接受“000”。
     * @return string
     */
    public function getBatchNo()
    {
        return $this->parameters['batch_no'];
    }

    /**
     * 退款批次号
     *
     * 每进行一次即时到账批量退款，都需要提供一个批次号，通过该批次号可以查询这一批次的退款交易记录，对于每一个合作伙伴，传递的每一个批次号都必须保证唯一性。
     * 格式为：退款日期（8位）+流水号（3～24位）。
     * 不可重复，且退款日期必须是当天日期。流水号可以接受数字或英文字符，建议使用数字，但不可接受“000”。
     *
     * @param string $batch_no
     * @return $this
     */
    public function setBatchNo($batch_no)
    {
        $this->parameters['batch_no'] = $batch_no;
        return $this;
    }

    /**
     * 总笔数
     *
     *即参数detail_data的值中，“#”字符出现的数量加1，最大支持1000笔（即“#”字符出现的最大数量为999个）。
     *
     * @return int
     */
    public function getBatchNum()
    {
        return count($this->parameters['detail_data']);
    }

    /**
     * 退款请求的明细数据。
     *
     * @return string
     */
    public function getDetailData()
    {
        return $this->parameters['detail_data'];
    }

    /**
     * 退款请求的明细数据。
     *
     * 格式如下：
     * $detail_data['trade_no'] 支付宝交易号
     * $detail_data['total_fee'] 退款总金额
     * $detail_data['reason'] 退款理由，长度不能大于256字节，“退款理由”中不能有“^”、“|”、“$”、“#”等影响detail_data格式的特殊字符；
     *
     * @param array $detail_data
     * @return $this
     */
    public function setDetailData(array $detail_data)
    {
        $this->parameters['detail_data'][] = $detail_data;
        return $this;
    }

}