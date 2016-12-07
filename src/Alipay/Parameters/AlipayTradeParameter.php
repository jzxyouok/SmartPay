<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:21
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\TradeParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 当面付下单参数
 * <p>收银员使用扫码设备读取用户手机支付宝“付款码”/声波获取设备（如麦克风）读取用户手机支付宝的声波信息后，将二维码或条码信息/声波信息通过本接口上送至支付宝发起支付。</p>
 * Class AlipayTradeParameter.php
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeParameter extends TradeParameter
{
    protected $method = 'alipay.trade.pay';

    use AlipayParameterTrait;

    protected $parameters = array(
        'out_trade_no'          => ['name' => 'out_trade_no','type' => 'string', 'length' => 64, 'require' => true, 'value' => null],
        'scene'                 => ['name' => 'scene','type' => 'string', 'length' => 32, 'require' => true, 'value' => null],
        'auth_code'             => ['name' => 'auth_code','type' => 'string', 'length' => 32, 'require' => true, 'value' => null],
        'subject'               => ['name' => 'subject','type' => 'string', 'length' => 256, 'require' => true, 'value' => null],
        'seller_id'             => ['name' => 'seller_id','type' => 'string', 'length' => 28, 'require' => false, 'value' => null],
        'total_amount'          => ['name' => 'total_amount','type' => 'float', 'length' => 11, 'require' => false, 'value' => null],
        'discountable_amount'   => ['name' => 'discountable_amount','type' => 'float', 'length' => 11, 'require' => false, 'value' => null],
        'undiscountable_amount' => ['name' => 'undiscountable_amount','type' => 'float', 'length' => 11, 'require' => false, 'value' => null],
        'body'                  => ['name' => 'body','type' => 'string', 'length' => 128, 'require' => false, 'value' => null],
        'goods_detail'          => ['name' => 'goods_detail','type' => 'array', 'length' => 0, 'require' => false, 'value' => null],
        'operator_id'           => ['name' => 'operator_id','type' => 'string', 'length' => 28, 'require' => false, 'value' => null],
        'store_id'              => ['name' => 'store_id','type' => 'string', 'length' => 32, 'require' => false, 'value' => null],
        'terminal_id'           => ['name' => 'terminal_id','type' => 'string', 'length' => 32, 'require' => false, 'value' => null],
        'alipay_store_id'       => ['name' => 'alipay_store_id','type' => 'string', 'length' => 32, 'require' => false, 'value' => null],
        'extend_params'         => ['name' => 'extend_params','type' => 'array', 'length' => 0, 'require' => false, 'value' => null],
        'timeout_express'       => ['name' => 'timeout_express','type' => 'string', 'length' => 6, 'require' => false, 'value' => null],
        'royalty_info'          => ['name' => 'royalty_info','type' => 'array', 'length' => 0, 'require' => false, 'value' => null],
        'sub_merchant'          => ['name' => 'sub_merchant','type' => 'array', 'length' => 0, 'require' => false, 'value' => null],
    );

    /**
     * 订单包含的商品列表信息，Json数组格式，其它说明详见商品明细说明
     * - goods_id 商品的编号
     * - alipay_goods_id 支付宝定义的统一商品编号
     * - goods_name 商品名称
     * - quantity 商品数量
     * - price 商品单价，单位为元
     * - goods_category 商品类目
     * - body 商品描述信息
     * - show_url 商品的展示地址
     * @return string
     */
    public function getGoodsDetail()
    {
        return $this->parameters['goods_detail']['value'];
    }

    /**
     * 订单包含的商品列表信息，Json数组格式，其它说明详见商品明细说明
     * - goods_id 商品的编号
     * - alipay_goods_id 支付宝定义的统一商品编号
     * - goods_name 商品名称
     * - quantity 商品数量
     * - price 商品单价，单位为元
     * - goods_category 商品类目
     * - body 商品描述信息
     * - show_url 商品的展示地址
     * @param string $goods_detail
     * @return AlipayTradeParameter.php
     */
    public function setGoodsDetail($goods_detail = null)
    {
        if($goods_detail !== null){
            $this->parameters['goods_detail']['value'] = $goods_detail;
        }
        return $this;
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
     * @return AlipayTradeParameter.php
     */
    public function setOperatorId($operator_id = null)
    {
        $this->parameters['operator_id']['value'] = $operator_id;

        return $this;
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
     * @return AlipayTradeParameter.php
     */
    public function setStoreId($store_id = null)
    {
        $this->parameters['store_id']['value'] = $store_id;
        return $this;
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
     * @return AlipayTradeParameter.php
     */
    public function setTerminalId($terminal_id = null)
    {
        $this->parameters['terminal_id']['value'] = $terminal_id;
        return $this;
    }

    /**
     * 支付宝的店铺编号
     * @return string
     */
    public function getAlipayStoreId()
    {
        return $this->parameters['alipay_store_id']['value'];
    }

    /**
     * 支付宝的店铺编号
     * @param string $alipay_store_id
     * @return AlipayTradeParameter.php
     */
    public function setAlipayStoreId($alipay_store_id = null)
    {
        $this->parameters['alipay_store_id']['value'] = $alipay_store_id;
        return $this;
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
     *
     * - sys_service_provider_id 系统商编号 该参数作为系统商返佣数据提取的依据，请填写系统商签约协议的PID
     * - hb_fq_num  使用花呗分期要进行的分期数
     * - hb_fq_seller_percent 使用花呗分期需要卖家承担的手续费比例的百分值，传入100代表100%
     *
     * @param string $extend_params
     * @return AlipayTradeParameter.php
     */
    public function setExtendParams($extend_params = null)
    {
        $this->parameters['extend_params']['value'] = $extend_params;
        return $this;
    }

    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易。
     * 取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。 该参数数值不接受小数点， 如 1.5h，可转换为 90m
     * @return string
     */
    public function getTimeoutExpress()
    {
        return $this->parameters['timeout_express']['value'];
    }

    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易。
     *
     * 取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。 该参数数值不接受小数点， 如 1.5h，可转换为 90m
     *
     * @param string $timeout_express
     * @return AlipayTradeParameter.php
     */
    public function setTimeoutExpress($timeout_express = '1d')
    {
        $this->parameters['timeout_express']['value'] = $timeout_express;
        return $this;
    }

    /**
     * 描述分账信息，Json格式，其它说明详见分账说明
     *
     * - royalty_type 分账类型 卖家的分账类型，目前只支持传入ROYALTY（普通分账类型）。
     *
     * - royalty_detail_infos 分账明细的信息，可以描述多条分账指令，json数组。
     * -- serial_no 分账序列号，表示分账执行的顺序，必须为正整数
     * -- trans_in_type 接受分账金额的账户类型： 	userId：支付宝账号对应的支付宝唯一用户号。  bankIndex：分账到银行账户的银行编号。目前暂时只支持分账到一个银行编号。 storeId：分账到门店对应的银行卡编号。 默认值为userId。
     * -- batch_no 分账批次号 分账批次号。 目前需要和转入账号类型为bankIndex配合使用。
     * -- out_relation_id 商户分账的外部关联号，用于关联到每一笔分账信息，商户需保证其唯一性。 如果为空，该值则默认为“商户网站唯一订单号+分账序列号”
     * -- trans_out_type 要分账的账户类型。 目前只支持userId：支付宝账号对应的支付宝唯一用户号。 默认值为userId。
     * -- trans_out 如果转出账号类型为userId，本参数为要分账的支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。
     * -- trans_in 如果转入账号类型为userId，本参数为接受分账金额的支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。 	如果转入账号类型为bankIndex，本参数为28位的银行编号（商户和支付宝签约时确定）。 如果转入账号类型为storeId，本参数为商户的门店ID。
     * -- amount 分账的金额，单位为元
     * -- desc 分账描述信息
     * -- amount_percenta 分账的比例，值为20代表按20%的比例分账
     * @return string
     */
    public function getRoyaltyInfo()
    {
        return $this->parameters['royalty_info']['value'];
    }

    /**
     * 描述分账信息，Json格式，其它说明详见分账说明
     *
     * @param string $royalty_info
     * @return AlipayTradeParameter.php
     */
    public function setRoyaltyInfo($royalty_info = null)
    {
        $this->parameters['royalty_info']['value'] = $royalty_info;
        return $this;
    }


    /**
     * 支付场景 条码支付，取值：bar_code 声波支付，取值：wave_code
     * @return string
     */
    public function getScene()
    {
        return $this->parameters['scene']['value'];
    }

    /**
     * 支付场景 条码支付，取值：bar_code 声波支付，取值：wave_code
     * @param string $scene
     * @return AlipayTradeParameter.php
     */
    public function setScene($scene)
    {
        $this->parameters['scene']['value']['value'] = $scene;
        return $this;
    }

    /**
     * 支付授权码
     * @return string
     */
    public function getAuthCode()
    {
        return $this->parameters['auth_code']['value'];
    }

    /**
     * 支付授权码
     * @param string $auth_code
     * @return AlipayTradeParameter.php
     */
    public function setAuthCode($auth_code)
    {
        $this->parameters['auth_code']['value'] = $auth_code;
        return $this;
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
     * @return AlipayTradeParameter.php
     */
    public function setSubject($subject)
    {
        $this->parameters['subject']['value'] = $subject;
        return $this;
    }

    /**
     * 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @return string
     */
    public function getSellerId()
    {
        return $this->parameters['seller_id']['value'];
    }

    /**
     * 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @param string $seller_id
     * @return AlipayTradeParameter.php
     */
    public function setSellerId($seller_id = null)
    {
        $this->parameters['seller_id']['value'] = $seller_id;
        return $this;
    }

    /**
     * 订单总金额，单位为元，精确到小数点后两位，
     * 取值范围[0.01,100000000]。 如果同时传入【可打折金额】和【不可打折金额】，该参数可以不用传入；
     * 如果同时传入了【可打折金额】，【不可打折金额】，【订单总金额】三者，则必须满足如下条件：【订单总金额】=【可打折金额】+【不可打折金额】
     *
     * @return int
     */
    public function getTotalAmount()
    {
        return $this->parameters['total_amount']['value'];
    }

    /**
     * 订单总金额，单位为元，精确到小数点后两位，
     * 取值范围[0.01,100000000]。 如果同时传入【可打折金额】和【不可打折金额】，该参数可以不用传入；
     * 如果同时传入了【可打折金额】，【不可打折金额】，【订单总金额】三者，则必须满足如下条件：【订单总金额】=【可打折金额】+【不可打折金额】
     *
     * @param int $total_amount
     * @return AlipayTradeParameter.php
     */
    public function setTotalAmount($total_amount)
    {
        $this->parameters['total_amount']['value'] = $total_amount;
        return $this;
    }

    /**
     *参与优惠计算的金额，单位为元，精确到小数点后两位，
     * 取值范围[0.01,100000000]。 如果该值未传入，但传入了【订单总金额】和【不可打折金额】，则该值默认为【订单总金额】-【不可打折金额】
     * @return int
     */
    public function getDiscountableAmount()
    {
        return $this->parameters['discountable_amount']['value'];
    }

    /**
     * 参与优惠计算的金额，单位为元，精确到小数点后两位，
     * 取值范围[0.01,100000000]。 如果该值未传入，但传入了【订单总金额】和【不可打折金额】，则该值默认为【订单总金额】-【不可打折金额】
     * @param int $discountable_amount
     * @return AlipayTradeParameter.php
     */
    public function setDiscountableAmount($discountable_amount = null)
    {
        $this->parameters['discountable_amount']['value'] = $discountable_amount;
        return $this;
    }

    /**
     * 	不参与优惠计算的金额，单位为元，精确到小数点后两位，
     * 取值范围[0.01,100000000]。如果该值未传入，但传入了【订单总金额】和【可打折金额】，则该值默认为【订单总金额】-【可打折金额】
     * @return int
     */
    public function getUndiscountableAmount()
    {
        return $this->parameters['undiscountable_amount']['value'];
    }

    /**
     * 	不参与优惠计算的金额，单位为元，精确到小数点后两位，
     * 取值范围[0.01,100000000]。如果该值未传入，但传入了【订单总金额】和【可打折金额】，则该值默认为【订单总金额】-【可打折金额】
     * @param int $undiscountable_amount
     * @return AlipayTradeParameter.php
     */
    public function setUndiscountableAmount($undiscountable_amount = null)
    {
        $this->parameters['undiscountable_amount']['value'] = $undiscountable_amount;
        return $this;
    }

    /**
     * 订单描述
     * @return string
     */
    public function getBody()
    {
        return $this->parameters['body']['value'];
    }

    /**
     * 订单描述
     * @param string $body
     * @return AlipayTradeParameter.php
     */
    public function setBody($body = null)
    {
        $this->parameters['body']['value'] = $body;
        return $this;
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
     * -  merchant_id 二级商户的支付宝id
     * @param string $sub_merchant
     * @return AlipayTradeParameter.php
     */
    public function setSubMerchant($sub_merchant = null)
    {
        $this->parameters['sub_merchant']['value'] = $sub_merchant;
        return $this;
    }


    /**
     * 商户订单号,64个字符以内、可包含字母、数字、下划线；需use AlipayParameterTrait;保证在商户端不重复
     *
     * @param $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no']['value'] = $out_trade_no;
        return $this;
    }

    /**
     * 商户订单号,64个字符以内、可包含字母、数字、下划线；需保证在商户端不重复
     * @return null|string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no']['value'];
    }

    protected function buildData()
    {
        $params = array();
        foreach ($this->parameters as $key => $item){
            if(isset($item['value']) &&  $item['value'] !== null){
                $params[$key] = $item['value'];
            }
        }

        $this->parameter->checkParams();

        $data = $this->parameter->getData();

        $data['biz_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        $this->requestData = $data;

    }



    /**
     * 检查参数是否正确
     * @throws PaymentException
     */
    protected function checkDataParams()
    {
        foreach ($this->parameters as $key => $item){
            if($item['require'] && (!isset($item['value']) || $item['value'] === null)){
                throw new PaymentException('提交被扫支付API接口中，缺少必填参数 ' . $key);
            }
            if($item['type'] === 'string' && isset($item['value']) && $item['value'] === null && mb_strlen($item['value']) > $item['length']){
                throw new PaymentException('提交被扫支付API接口中，参数 ' . $key . ' 长度不能超过 ' . $item['length'] );
            }
        }
    }

}