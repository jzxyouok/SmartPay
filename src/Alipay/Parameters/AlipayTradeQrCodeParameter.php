<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 11:09
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\QrCodeParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单线下交易预创建[生成二维码的数据]
 *
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.PlTwKb&apiId=862&docType=4
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeQrCodeParameter extends QrCodeParameter
{
    protected $method = 'alipay.trade.precreate';
    use AlipayParameterTrait;
    protected $parameters = [
        'out_trade_no'  => ['name' => 'out_trade_no','type' => 'string', 'length' => 64, 'require' => true, 'value' => null],
        'seller_id'    => ['name' => 'seller_id','type' => 'string', 'length' => 28, 'require' => false, 'value' => null],
        'total_amount' => ['name' => 'total_amount','type' => 'string', 'length' => 11, 'require' => true, 'value' => null],
        'discountable_amount'  => ['name' => 'discountable_amount','type' => 'float', 'length' => 64, 'require' => false, 'value' => null],
        'undiscountable_amount'    => ['name' => 'undiscountable_amount','type' => 'float', 'length' => 11, 'require' => false, 'value' => null],
        'buyer_logon_id'   => ['name' => 'buyer_logon_id','type' => 'string', 'length' => 100, 'require' => false, 'value' => null],
        'subject'          => ['name' => 'subject','type' => 'string', 'length' => 256, 'require' => true, 'value' => null],
        'body'             => ['name' => 'body','type' => 'string', 'length' => 128, 'require' => false, 'value' => null],
        'goods_detail'     => ['name' => 'goods_detail','type' => 'array', 'length' => 0, 'require' => false, 'value' => []],
        'operator_id'      => ['name' => 'operator_id','type' => 'string', 'length' => 28, 'require' => false, 'value' => null],
        'store_id'         => ['name' => 'store_id','type' => 'string', 'length' => 32, 'require' => false, 'value' => null],
        'terminal_id'      => ['name' => 'terminal_id','type' => 'string', 'length' => 32, 'require' => false, 'value' => null],
        'extend_params'    => ['name' => 'extend_params','type' => 'array', 'length' => 0, 'require' => false, 'value' => []],
        'timeout_express'  => ['name' => 'timeout_express','type' => 'string', 'length' => 6, 'require' => false, 'value' => '1d'],
        'royalty_info'     => ['name' => 'royalty_info','type' => 'json', 'length' => 2500, 'require' => false, 'value' => []],
        'sub_merchant'     => ['name' => 'sub_merchant','type' => 'array', 'length' => 0, 'require' => false, 'value' => []],
        'alipay_store_id'  => ['name' => 'alipay_store_id','type' => 'string', 'length' => 32, 'require' => false, 'value' => null],
    ];

    protected function buildData()
    {
        $params = array();
        foreach ($this->parameters as $key => $item){
            if(isset($item['value']) && empty($item['value']) === false){
                if($item['type'] == 'json'){
                    $params[$key] = json_encode($item['value'],JSON_UNESCAPED_UNICODE);
                }else{
                    $params[$key] = $item['value'];
                }
            }
        }

        $this->parameter->checkParams();

        $data = $this->parameter->getData();

        $data['biz_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        $this->requestData = $data;
    }

    protected function checkDataParams()
    {
        foreach ($this->parameters as $key => $item){
            if(isset($item['require']) && $item['require'] && (!isset($item['value']) || $item['value'] === null)){
                throw new PaymentException('提交被扫支付API接口中，缺少必填参数 ' . $key);
            }
            if($item['type'] === 'string' && isset($item['value']) && $item['value'] === null && mb_strlen($item['value']) > $item['length']){
                throw new PaymentException('提交被扫支付API接口中，参数 ' . $key . ' 长度不能超过 ' . $item['length'] );
            }
        }
    }

    /**
     * 商户订单号,64个字符以内、只能包含字母、数字、下划线；需保证在商户端不重复
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no']['value'];
    }

    /**
     * 商户订单号,64个字符以内、只能包含字母、数字、下划线；需保证在商户端不重复
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no']['value'] = $out_trade_no;
    }

    /**
     * 卖家支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @return string
     */
    public function getSellerId()
    {
        return $this->parameters['seller_id']['value'];
    }

    /**
     * 卖家支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @param string $seller_id
     */
    public function setSellerId($seller_id = null)
    {
        $this->parameters['seller_id']['value'] = $seller_id;
    }

    /**
     * 	订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000] 如果同时传入了【打折金额】，【不可打折金额】，【订单总金额】三者，则必须满足如下条件：【订单总金额】=【打折金额】+【不可打折金额】
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->parameters['total_amount']['value'];
    }

    /**
     * 	订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000] 如果同时传入了【打折金额】，【不可打折金额】，【订单总金额】三者，则必须满足如下条件：【订单总金额】=【打折金额】+【不可打折金额】
     * @param string $total_amount
     */
    public function setTotalAmount($total_amount)
    {
        $this->parameters['total_amount']['value'] = $total_amount;
    }

    /**
     * 	可打折金额. 参与优惠计算的金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000] 如果该值未传入，但传入了【订单总金额】，【不可打折金额】则该值默认为【订单总金额】-【不可打折金额】
     * @return string
     */
    public function getDiscountableAmount()
    {
        return $this->parameters['discountable_amount']['value'];
    }

    /**
     * 	可打折金额. 参与优惠计算的金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000] 如果该值未传入，但传入了【订单总金额】，【不可打折金额】则该值默认为【订单总金额】-【不可打折金额】
     * @param string $discountable_amount
     */
    public function setDiscountableAmount($discountable_amount = null)
    {
        $this->parameters['discountable_amount']['value'] = $discountable_amount;
    }

    /**
     * 不可打折金额. 不参与优惠计算的金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000] 如果该值未传入，但传入了【订单总金额】,【打折金额】，则该值默认为【订单总金额】-【打折金额】
     * @return string
     */
    public function getUndiscountableAmount()
    {
        return $this->parameters['undiscountable_amount']['value'];
    }

    /**
     * 不可打折金额. 不参与优惠计算的金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000] 如果该值未传入，但传入了【订单总金额】,【打折金额】，则该值默认为【订单总金额】-【打折金额】
     * @param string $undiscountable_amount
     */
    public function setUndiscountableAmount($undiscountable_amount = null)
    {
        $this->parameters['undiscountable_amount']['value'] = $undiscountable_amount;
    }

    /**
     * 买家支付宝账号
     * @return string
     */
    public function getBuyerLogonId()
    {
        return $this->parameters['buyer_logon_id']['value'];
    }

    /**
     * 买家支付宝账号
     * @param string $buyer_logon_id
     */
    public function setBuyerLogonId($buyer_logon_id = null)
    {
        $this->parameters['buyer_logon_id']['value'] = $buyer_logon_id;
    }

    /**
     * 订单标题
     * @return string
     */
    public function getSubject()
    {
        return $this->parameters['subject']['value'];
    }

    /**
     * 订单标题
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->parameters['subject']['value'] = $subject;
    }

    /**
     * 对交易或商品的描述
     * @return string
     */
    public function getBody()
    {
        return $this->parameters['body']['value'];
    }

    /**
     * 对交易或商品的描述
     * @param string $body
     */
    public function setBody($body = null)
    {
        $this->parameters['body']['value'] = $body;
    }

    /**
     * 订单包含的商品列表信息.Json格式. 其它说明详见：“商品明细说明”
     * @return string
     */
    public function getGoodsDetail()
    {
        return $this->parameters['goods_detail']['value'];
    }

    /**
     * 订单包含的商品列表信息.Json格式. 其它说明详见：“商品明细说明”
     * @param array $goods_detail
     * $goods_detail['goods_id'] 商品的编号
     * $goods_detail['alipay_goods_id'] 支付宝定义的统一商品编号
     * $goods_detail['goods_name'] 商品名称
     * $goods_detail['quantity'] 商品数量
     * $goods_detail['price'] 商品单价，单位为元
     * $goods_detail['goods_category'] 商品类目
     * $goods_detail['body'] 商品描述信息
     * $goods_detail['show_url'] 商品的展示地址
     */
    public function setGoodsDetail(array $goods_detail = null)
    {
        $this->parameters['goods_detail']['value'] = $goods_detail;
    }

    /**
     * 商户操作员编号
     * @return string
     */
    public function getOperatorId()
    {
        return $this->parameters['operator_id']['value'];
    }

    /**
     * 商户操作员编号
     * @param string $operator_id
     */
    public function setOperatorId($operator_id = null)
    {
        $this->parameters['operator_id']['value'] = $operator_id;
    }

    /**
     * 商户门店编号
     * @return string
     */
    public function getStoreId()
    {
        return $this->parameters['store_id']['value'];
    }

    /**
     * 商户门店编号
     * @param string $store_id
     */
    public function setStoreId($store_id = null)
    {
        $this->parameters['store_id']['value'] = $store_id;
    }

    /**
     * 商户机具终端编号
     * @return string
     */
    public function getTerminalId()
    {
        return $this->parameters['terminal_id']['value'];
    }

    /**
     * 商户机具终端编号
     * @param string $terminal_id
     */
    public function setTerminalId($terminal_id = null)
    {
        $this->parameters['terminal_id']['value'] = $terminal_id;
    }

    /**
     * 业务扩展参数
     * @return string
     */
    public function getExtendParams()
    {
        return $this->parameters['extend_params']['value'];
    }

    /**
     * 业务扩展参数
     * @param array $extend_params
     * $extend_params['sys_service_provider_id'] 系统商编号 该参数作为系统商返佣数据提取的依据，请填写系统商签约协议的PID
     * $extend_params['hb_fq_num'] 使用花呗分期要进行的分期数
     * $extend_params['hb_fq_seller_percent'] 使用花呗分期需要卖家承担的手续费比例的百分值，传入100代表100%
     */
    public function setExtendParams(array $extend_params = null)
    {
        $this->parameters['extend_params']['value'] = $extend_params;
    }

    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易。取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
     * @return string
     */
    public function getTimeoutExpress()
    {
        return $this->parameters['timeout_express']['value'];
    }

    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易。
     * 取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
     *
     * @param string $timeout_express
     */
    public function setTimeoutExpress($timeout_express = '1d')
    {
        $this->parameters['timeout_express']['value'] = $timeout_express;
    }

    /**
     * 描述分账信息，json格式。
     *
     * @return string
     */
    public function getRoyaltyInfo()
    {
        return $this->parameters['royalty_info']['value'];
    }

    /**
     * 描述分账信息，json格式。
     *
     * @param array $royalty_info
     *
     * $royalty_info['royalty_type'] 分账类型 卖家的分账类型，目前只支持传入ROYALTY（普通分账类型）。
     * $royalty_info['royalty_detail_infos']['serial_no'] 分账序列号，表示分账执行的顺序，必须为正整数
     * $royalty_info['royalty_detail_infos']['trans_in_type'] 接受分账金额的账户类型： 	userId：支付宝账号对应的支付宝唯一用户号。  bankIndex：分账到银行账户的银行编号。目前暂时只支持分账到一个银行编号。 storeId：分账到门店对应的银行卡编号。 默认值为userId。
     * $royalty_info['royalty_detail_infos']['batch_no'] 分账批次号 分账批次号。 目前需要和转入账号类型为bankIndex配合使用。
     * $royalty_info['royalty_detail_infos']['out_relation_id'] 商户分账的外部关联号，用于关联到每一笔分账信息，商户需保证其唯一性。 如果为空，该值则默认为“商户网站唯一订单号+分账序列号”
     * $royalty_info['royalty_detail_infos']['trans_out_type'] 要分账的账户类型。 目前只支持userId：支付宝账号对应的支付宝唯一用户号。 默认值为userId。
     * $royalty_info['royalty_detail_infos']['trans_out'] 如果转出账号类型为userId，本参数为要分账的支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。
     * $royalty_info['royalty_detail_infos']['trans_in'] 如果转入账号类型为userId，本参数为接受分账金额的支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。 	如果转入账号类型为bankIndex，本参数为28位的银行编号（商户和支付宝签约时确定）。 如果转入账号类型为storeId，本参数为商户的门店ID。
     * $royalty_info['royalty_detail_infos']['amount'] 分账的金额，单位为元
     * $royalty_info['royalty_detail_infos']['desc'] 分账描述信息
     * $royalty_info['royalty_detail_infos']['amount_percentage']  分账的比例，值为20代表按20%的比例分账
     *
     */
    public function setRoyaltyInfo(array $royalty_info = null)
    {
        $this->parameters['royalty_info']['value'] = $royalty_info;
    }

    /**
     * 二级商户信息,当前只对特殊银行机构特定场景下使用此字段
     * @return string
     */
    public function getSubMerchant()
    {
        return $this->parameters['sub_merchant']['value'];
    }

    /**
     * 二级商户信息,当前只对特殊银行机构特定场景下使用此字段
     * @param array $sub_merchant
     * $sub_merchant['merchant_id']  二级商户的支付宝id
     */
    public function setSubMerchant(array $sub_merchant = null)
    {
        $this->parameters['sub_merchant']['value'] = $sub_merchant;
    }

    /**
     * 支付宝店铺的门店ID
     * @return string
     */
    public function getAlipayStoreId()
    {
        return $this->parameters['alipay_store_id']['value'];
    }

    /**
     * 支付宝店铺的门店ID
     * @param string $alipay_store_id
     */
    public function setAlipayStoreId($alipay_store_id = null)
    {
        $this->parameters['alipay_store_id']['value'] = $alipay_store_id;
    }
}