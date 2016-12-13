<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 14:25
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\TradeParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 手机网站支付接口
 *
 * @link https://doc.open.alipay.com/doc2/detail.htm?treeId=203&articleId=105463&docType=1
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeWapParameter extends TradeParameter
{
    protected $method = 'alipay.trade.wap.pay';

    use AlipayParameterTrait;

    protected $parameters = [
        'body' => ['name' => 'body','type' => 'string', 'length' => 128, 'require' => false, 'value' => null],
        'subject' => ['name' => 'subject','type' => 'string', 'length' => 256, 'require' => true, 'value' => null],
        'out_trade_no' => ['name' => 'out_trade_no','type' => 'string', 'length' => 64, 'require' => true, 'value' => null],
        'timeout_express' => ['name' => 'timeout_express','type' => 'string', 'length' => 6, 'require' => false, 'value' => '1d'],
        'total_amount' => ['name' => 'total_amount','type' => 'float', 'length' => 9, 'require' => true, 'value' => null],
        'seller_id' => ['name' => 'seller_id','type' => 'string', 'length' => 28, 'require' => false, 'value' => null],
        'auth_token' => ['name' => 'auth_token','type' => 'string', 'length' => 40, 'require' => false, 'value' => null],
        'product_code' => ['name' => 'product_code','type' => 'string', 'length' => 64, 'require' => false, 'value' => null],
        'goods_type' => ['name' => 'goods_type','type' => 'string', 'length' => 2, 'require' => false, 'value' => '0'],
        'passback_params' => ['name' => 'passback_params','type' => 'string', 'length' => 512, 'require' => false, 'value' => null],
        'promo_params' => ['name' => 'promo_params','type' => 'json', 'length' => 512, 'require' => false, 'value' => null],
        'extend_params' => ['name' => 'extend_params','type' => 'json', 'length' => 128, 'require' => false, 'value' => null],
        'enable_pay_channels' => ['name' => 'enable_pay_channels','type' => 'string', 'length' => 128, 'require' => false, 'value' => null],
        'disable_pay_channels' => ['name' => 'disable_pay_channels','type' => 'string', 'length' => 128, 'require' => false, 'value' => null],
    ];

    protected function buildData()
    {
        $params = array();
        foreach ($this->parameters as $key => $item){
            if(isset($item['value'])){
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
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     *
     * @return string
     */
    public function getBody()
    {
        return $this->parameters['body']['value'];
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     * @param string $body
     * @return $this
     */
    public function setBody($body = null)
    {
        $this->parameters['body']['value'] = $body;
        return $this;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->parameters['subject']['value'];
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->parameters['subject']['value'] = $subject;
        return $this;
    }

    /**
     * 商户网站唯一订单号
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no']['value'];
    }

    /**
     * 商户网站唯一订单号
     *
     * @param string $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no']['value'] = $out_trade_no;
        return $this;
    }

    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易。
     * 取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
     *
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
     * @return $this
     */
    public function setTimeoutExpress($timeout_express = '1d')
    {
        $this->parameters['timeout_express']['value'] = $timeout_express;
        return $this;
    }

    /**
     * 订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
     *
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->parameters['total_amount']['value'];
    }

    /**
     * 订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
     *
     * @param string $total_amount
     * @return $this
     */
    public function setTotalAmount($total_amount)
    {
        $this->parameters['total_amount']['value'] = $total_amount;
        return $this;
    }

    /**
     * 收款支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     *
     * @return string
     */
    public function getSellerId()
    {
        return $this->parameters['seller_id']['value'];
    }

    /**
     * 收款支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     *
     * @param string $seller_id
     * @return $this
     */
    public function setSellerId($seller_id = null)
    {
        $this->parameters['seller_id']['value'] = $seller_id;
        return $this;
    }

    /**
     * 针对用户授权接口，获取用户相关数据时，用于标识用户授权关系
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->parameters['auth_token']['value'];
    }

    /**
     * 针对用户授权接口，获取用户相关数据时，用于标识用户授权关系
     *
     * @param string $auth_token
     * @return $this
     */
    public function setAuthToken($auth_token = null)
    {
        $this->parameters['auth_token']['value'] = $auth_token;
        return $this;
    }

    /**
     * 销售产品码，商家和支付宝签约的产品码
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->parameters['product_code']['value'];
    }

    /**
     * 销售产品码，商家和支付宝签约的产品码
     *
     * @param string $product_code
     * @return $this
     */
    public function setProductCode($product_code)
    {
        $this->parameters['product_code']['value'] = $product_code;
        return $this;
    }

    /**
     * 商品主类型：0—虚拟类商品，1—实物类商品
     * 注：虚拟类商品不支持使用花呗渠道
     *
     * @return string
     */
    public function getGoodsType()
    {
        return $this->parameters['goods_type']['value'];
    }

    /**
     *  商品主类型：0—虚拟类商品，1—实物类商品
     *  注：虚拟类商品不支持使用花呗渠道
     *
     * @param string $goods_type
     * @return $this
     */
    public function setGoodsType($goods_type = '0')
    {
        $this->parameters['goods_type']['value'] = $goods_type;
        return $this;
    }

    /**
     * 公用回传参数，如果请求时传递了该参数，则返回给商户时会回传该参数。支付宝会在异步通知时将该参数原样返回。
     * 本参数必须进行UrlEncode之后才可以发送给支付宝
     *
     * @return string
     */
    public function getPassbackParams()
    {
        return $this->parameters['passback_params']['value'];
    }

    /**
     * 公用回传参数，如果请求时传递了该参数，则返回给商户时会回传该参数。支付宝会在异步通知时将该参数原样返回。
     * 本参数必须进行UrlEncode之后才可以发送给支付宝
     *
     * @param string $passback_params
     * @return $this
     */
    public function setPassbackParams($passback_params = null)
    {
        $this->parameters['passback_params']['value'] = $passback_params;
        return $this;
    }

    /**
     * 优惠参数
     * 注：仅与支付宝协商后可用
     *
     * @return string
     */
    public function getPromoParams()
    {
        return $this->parameters['promo_params']['value']['storeIdType'];
    }

    /**
     * 优惠参数
     * 注：仅与支付宝协商后可用
     *
     * @param string $promo_params
     * @return $this
     */
    public function setPromoParams($promo_params = null)
    {
        $this->parameters['promo_params']['value']['storeIdType'] = $promo_params;
        return $this;
    }

    /**
     * 业务扩展参数
     *
     * @return string
     */
    public function getExtendParams()
    {
        if(isset($this->parameters['extend_params']['value']['sys_service_provider_id'] )) {
            return $this->parameters['extend_params']['value']['sys_service_provider_id'];
        }
        return null;
    }

    /**
     * 业务扩展参数
     *
     * @param string $extend_params
     * @return $this
     */
    public function setExtendParams($extend_params = null)
    {
        $this->parameters['extend_params']['value']['sys_service_provider_id'] = $extend_params;
        return $this;
    }

    /**
     * 可用渠道，用户只能在指定渠道范围内支付
     * 当有多个渠道时用“,”分隔
     * 注：与disable_pay_channels互斥
     *
     * @return string
     */
    public function getEnablePayChannels()
    {
        return $this->parameters['enable_pay_channels']['value'];
    }

    /**
     * 可用渠道，用户只能在指定渠道范围内支付
     * 当有多个渠道时用“,”分隔
     * 注：与disable_pay_channels互斥
     *
     * @param string $enable_pay_channels
     * @return $this
     */
    public function setEnablePayChannels($enable_pay_channels = null)
    {
        $this->parameters['enable_pay_channels']['value'] = $enable_pay_channels;
        return $this;
    }

    /**
     * 禁用渠道，用户不可用指定渠道支付
     * 当有多个渠道时用“,”分隔
     * 注：与enable_pay_channels互斥
     *
     * @return string
     */
    public function getDisablePayChannels()
    {
        return $this->parameters['disable_pay_channels']['value'];
    }

    /**
     * 禁用渠道，用户不可用指定渠道支付
     * 当有多个渠道时用“,”分隔
     * 注：与enable_pay_channels互斥
     *
     * @param string $disable_pay_channels
     * @return $this
     */
    public function setDisablePayChannels($disable_pay_channels = null)
    {
        $this->parameters['disable_pay_channels']['value'] = $disable_pay_channels;
        return $this;
    }


}