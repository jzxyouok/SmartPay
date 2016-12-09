<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 16:53
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\OrderParameter;
use Payment\Support\Traits\AlipayWapParameterTrait;

/**
 * 批量付款到支付宝账户有密接口
 *
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.0tOdsU&treeId=64&articleId=104804&docType=1
 *
 * Class AlipayWapTransParameter
 * @package Payment\Alipay\Parameters
 * @property string $account_name
 * @property string $detail_data
 * @property string $batch_no
 * @property string $batch_num
 * @property string $batch_fee
 * @property string $email
 * @property string $pay_date
 * @property string $buyer_account_name
 * @property string $extend_param
 *
 */
class AlipayWapTransParameter extends OrderParameter
{
    use AlipayWapParameterTrait ;

    protected $parameters = array(
        'service' => 'batch_trans_notify',
        'partner'          => null,
        '_input_charset'    => 'UTF-8',
        'sign_type'         => 'RSA',
        'account_name'      => null,
        'detail_data'       => null,
        'batch_no'          => null,
        'batch_num'         => null,
        'batch_fee'         => null,
        'email'             => null,
        'pay_date'          => null,
        'buyer_account_name'=> null,
        'extend_param'      => null
    );

    public function __construct($partner)
    {
        parent::__construct($partner);

        $this->parameters['partner'] = $partner;
    }

    protected function buildData()
    {
        $data = $this->parameters;

        $detail_data = $this->getDetailData();
        $detailBuffer = '';
        $count = 0;
        foreach ($detail_data as $item){
            $remark = str_replace(['^', '|', '$', '#'],['','','',''],$item['remark']);
            if(empty($remark) || mb_strlen($remark) > 50){
                throw new PaymentException('备注说明不能为空，并且不能超过50个字符');
            }
            // 检查流水号
            if (empty($item['serial_no']) || mb_strlen($item['serial_no']) > 22) {
                throw new PaymentException('流水号不能为空，并且长度不能超过22个字符');
            }
            // 检查收款方账号
            if (empty($item['user_account']) || mb_strlen($item['user_account']) > 50) {
                throw new PaymentException('收款方账号不能为空，并且长度不能超过50个字符');
            }
            // 检查付款金额
            if (bccomp($item['total_fee'], '0.01', 2) === -1) {
                throw new PaymentException('交易金额小于0.01');
            }
            // 检查收款方姓名
            if (empty($item['user_name'])) {
                throw new PaymentException('收款方姓名不能为空');
            }
            $detailBuffer = "{$detailBuffer}{$item['serial_no']}^{$item['user_account']}^{$item['user_name']}^{$item['total_fee']}^{$remark}|";
            $count ++;
        }
        $data['detail_data'] = trim($detailBuffer,'|');
        $data['batch_num'] = $count;

        if(empty($this->parameters['extend_param']) === false){
            $buffer = '';
            foreach ($this->parameters['extend_param'] as $item){
                $key = str_replace(['^', '|', '$', '#'],['','','',''],$item['key']);
                $value = str_replace(['^', '|', '$', '#'],['','','',''],$item['value']);
                $buffer = "{$buffer}{$key}^{$value}|";
            }
            $data['extend_param'] = trim($buffer);
        }
        $this->requestData = $data;
    }

    /**
     * 检查数据的合法性
     * @throws PaymentException
     */
    protected function checkDataParams()
    {
        // TODO: Implement checkDataParams() method.
        if($this->parameters['account_name'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 account_name');
        }
        if($this->parameters['batch_no'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 batch_no');
        }
        if(strlen($this->parameters['batch_no']) > 32 || strlen($this->parameters['batch_no']) < 11){
            throw new PaymentException('提交被扫支付API接口中，参数 batch_no 必须在 11-32字符之间');
        }

        if(bccomp($this->parameters['batch_fee'],'0.01',2) === -1){
            throw new PaymentException("付款文件中的总金额，必须大于0.01");
        }
        if($this->parameters['email'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 email');
        }
    }

    /**
     * 付款方的支付宝账户名。
     * @return string
     */
    public function getAccountName()
    {
        return $this->parameters['account_name'];
    }

    /**
     * 付款方的支付宝账户名。
     * @param string $account_name
     * @return $this
     */
    public function setAccountName($account_name)
    {
        $this->parameters['account_name'] = $account_name;
        return $this;
    }

    /**
     * 付款的详细数据，最多支持1000笔。
     * 格式为：流水号1^收款方账号1^收款账号姓名1^付款金额1^备注说明1|流水号2^收款方账号2^收款账号姓名2^付款金额2^备注说明2。
     * 每条记录以“|”间隔。
     * 流水号不能超过64字节，收款方账号小于100字节，备注不能超过200字节。当付款方为企业账户，且转账金额达到（大于等于）50000元，备注不能为空。
     *
     * @return array
     */
    public function getDetailData()
    {
        return $this->parameters['detail_data'];
    }

    /**
     * 付款的详细数据，最多支持1000笔。
     * 格式为：流水号1^收款方账号1^收款账号姓名1^付款金额1^备注说明1|流水号2^收款方账号2^收款账号姓名2^付款金额2^备注说明2。
     * 每条记录以“|”间隔。
     * 流水号不能超过64字节，收款方账号小于100字节，备注不能超过200字节。当付款方为企业账户，且转账金额达到（大于等于）50000元，备注不能为空。
     *
     * @param array $detail_data
     *
     * $detail_data['serial_no'] 流水号
     * $detail_data['user_account'] 收款方账号
     * $detail_data['user_name'] 收款账号姓名
     * $detail_data['total_fee'] 付款金额
     * $detail_data['remark'] 备注说明
     *
     * @return $this
     */
    public function setDetailData(array $detail_data)
    {
        $this->parameters['detail_data'][] = $detail_data;
        return $this;
    }

    /**
     * 批量付款批次号。
     * 11～32位的数字或字母或数字与字母的组合，且区分大小写。
     * 注意：
     * 批量付款批次号用作业务幂等性控制的依据，一旦提交受理，请勿直接更改批次号再次上传。
     *
     * @return string
     */
    public function getBatchNo()
    {
        return $this->parameters['batch_no'];
    }

    /**
     * 批量付款批次号。
     * 11～32位的数字或字母或数字与字母的组合，且区分大小写。
     * 注意：
     * 批量付款批次号用作业务幂等性控制的依据，一旦提交受理，请勿直接更改批次号再次上传。
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
     * 批量付款笔数（最少1笔，最多1000笔）。
     *
     * @return string
     */
    public function getBatchNum()
    {
        return count($this->parameters['detail_data']);
    }


    /**
     * 付款文件中的总金额。
     * 格式：10.01，精确到分。
     * @return string
     */
    public function getBatchFee()
    {
        return $this->parameters['batch_fee'];
    }

    /**
     * 付款文件中的总金额。
     * 格式：10.01，精确到分。
     *
     * @param string $batch_fee
     * @return $this
     */
    public function setBatchFee($batch_fee)
    {
        $this->parameters['batch_fee'] = $batch_fee;
        return $this;
    }

    /**
     * 付款方的支付宝账号，支持邮箱和手机号2种格式。
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->parameters['email'];
    }

    /**
     * 付款方的支付宝账号，支持邮箱和手机号2种格式。
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->parameters['email'] = $email;
        return $this;
    }

    /**
     * 支付时间（必须为当前日期）。
     * 格式：YYYYMMDD。
     *
     * @return string
     */
    public function getPayDate()
    {
        return $this->parameters['pay_date'];
    }

    /**
     * 支付时间（必须为当前日期）。
     * 格式：YYYYMMDD。
     *
     * @param string $pay_date
     * @return $this
     */
    public function setPayDate($pay_date)
    {
        $this->parameters['pay_date'] = $pay_date;
        return $this;
    }

    /**
     * 同email参数，可以使用该参数名代替email输入参数；优先级大于email。
     *
     * @return string
     */
    public function getBuyerAccountName()
    {
        return $this->parameters['buyer_account_name'];
    }

    /**
     * 同email参数，可以使用该参数名代替email输入参数；优先级大于email。
     *
     * @param string $buyer_account_name
     * @return $this
     */
    public function setBuyerAccountName($buyer_account_name)
    {
        $this->parameters['buyer_account_name'] = $buyer_account_name;
        return $this;
    }

    /**
     * 用于商户的特定业务信息的传递，只有商户与支付宝约定了传递此参数且约定了参数含义，此参数才有效。
     * 参数格式：参数名1^参数值1|参数名2^参数值2|……
     * 多条数据用“|”间隔。
     *
     * @return string
     */
    public function getExtendParam()
    {
        return $this->parameters['extend_param'];
    }

    /**
     * 用于商户的特定业务信息的传递，只有商户与支付宝约定了传递此参数且约定了参数含义，此参数才有效。
     * 参数格式：参数名1^参数值1|参数名2^参数值2|……
     * 多条数据用“|”间隔。
     *
     * @param array $extend_param
     * $extend_param['key'] 键
     * $extend_param['value'] 值
     * @return $this
     */
    public function setExtendParam(array $extend_param)
    {
        $this->parameters['extend_param'][] = $extend_param;
        return $this;
    }


}