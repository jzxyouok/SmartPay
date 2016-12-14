<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 17:01
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AppParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * App支付请求参数说明
 *
 * @package Payment\Alipay\Parameters
 *
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.eW2a6y&treeId=193&articleId=105465&docType=1
 *
 */
class AlipayTradeAppParameter extends AppParameter
{
    protected $method = 'alipay.trade.app.pay';

    use AlipayParameterTrait;

    protected $parameters = [
        'body' => null,
        'subject' => null,
        'out_trade_no' => null,
        'timeout_express' => null,
        'total_amount' => null,
        'seller_id' => null,
        'product_code' => 'QUICK_MSECURITY_PAY',
        'goods_type' => null,
        'passback_params' => null,
        'promo_params' => null,
        'extend_params' => null,
        'enable_pay_channels' => null,
        'disable_pay_channels' => null,
        'sys_service_provider_id' => null
    ];

    protected function checkDataParams()
    {
        if(empty($this->parameters['subject']) || strlen($this->parameters['subject']) > 256){
            throw new PaymentException('subject 不能为空且必须小于256个字符');
        }
        if(empty($this->parameters['out_trade_no']) || strlen($this->parameters['out_trade_no']) > 64){
            throw new PaymentException('out_trade_no 不能为空且必须小于64个字符');
        }
        if(empty($this->parameters['total_amount']) ){
            throw new PaymentException('total_amount 不能为空');
        }
        if(empty($this->parameters['product_code']) || strlen($this->parameters['product_code']) > 64){
            throw new PaymentException('product_code 不能为空且必须小于64个字符');
        }
        if(empty($this->parameters['passback_params']) && mb_strlen($this->parameters['passback_params']) > 512){
            throw new PaymentException('passback_params 必须小于512个字符');
        }

    }

    protected function buildData()
    {
        $params = [];
        foreach ($this->parameters as $key=>$parameter){
            if(empty($parameter) === false){
                if(strcasecmp('promo_params',$key) === 0){
                    $params['promo_params'] = json_encode($parameter,JSON_UNESCAPED_UNICODE);
                }elseif (strcasecmp('extend_params',$key) === 0){
                    $params['extend_params'] = json_encode($parameter,JSON_UNESCAPED_UNICODE);
                }else{
                    $params[$key] = $parameter;
                }
            }
        }

        $this->requestData = $params;
    }


    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     * @return string
     */
    public function getBody()
    {
        return $this->parameters['body'];
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     * @param string $body
     */
    public function setBody($body = null)
    {
        $this->parameters['body'] = $body;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     * @return string
     */
    public function getSubject()
    {
        return $this->parameters['subject'];
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->parameters['subject'] = $subject;
    }

    /**
     * 商户网站唯一订单号
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 商户网站唯一订单号
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
    }

    /**
     *    该笔订单允许的最晚付款时间，逾期将关闭交易。
     * 取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
     *
     * @return string
     */
    public function getTimeoutExpress()
    {
        return $this->parameters['timeout_express'];
    }

    /**
     * 该笔订单允许的最晚付款时间，逾期将关闭交易。
     * 取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
     * @param string $timeout_express
     */
    public function setTimeoutExpress($timeout_express = '1d')
    {
        $this->parameters['timeout_express'] = $timeout_express;
    }

    /**
     * 订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->parameters['total_amount'];
    }

    /**
     * 订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
     * @param string $total_amount
     */
    public function setTotalAmount($total_amount)
    {
        $this->parameters['total_amount'] = $total_amount;
    }

    /**
     * 收款支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @return string
     */
    public function getSellerId()
    {
        return $this->parameters['seller_id'];
    }

    /**
     * 收款支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @param string $seller_id
     */
    public function setSellerId($seller_id = null)
    {
        $this->parameters['seller_id'] = $seller_id;
    }

    /**
     * 销售产品码，商家和支付宝签约的产品码，为固定值QUICK_MSECURITY_PAY
     * @return string
     */
    public function getProductCode()
    {
        return $this->parameters['product_code'];
    }

    /**
     * 销售产品码，商家和支付宝签约的产品码，为固定值QUICK_MSECURITY_PAY
     * @param string $product_code
     */
    public function setProductCode($product_code)
    {
        $this->parameters['product_code'] = $product_code;
    }

    /**
     * 商品主类型：0—虚拟类商品，1—实物类商品
     * 注：虚拟类商品不支持使用花呗渠道
     * @return string
     */
    public function getGoodsType()
    {
        return $this->parameters['goods_type'];
    }

    /**
     * 商品主类型：0—虚拟类商品，1—实物类商品
     * 注：虚拟类商品不支持使用花呗渠道
     * @param string $goods_type
     */
    public function setGoodsType($goods_type = '0')
    {
        $this->parameters['goods_type'] = $goods_type;
    }

    /**
     * 公用回传参数，如果请求时传递了该参数，则返回给商户时会回传该参数。支付宝会在异步通知时将该参数原样返回。本参数必须进行UrlEncode之后才可以发送给支付宝
     * @return string
     */
    public function getPassbackParams()
    {
        return $this->parameters['passback_params'];
    }

    /**
     * 公用回传参数，如果请求时传递了该参数，则返回给商户时会回传该参数。支付宝会在异步通知时将该参数原样返回。本参数必须进行UrlEncode之后才可以发送给支付宝
     * @param string $passback_params
     */
    public function setPassbackParams($passback_params)
    {
        $this->parameters['passback_params'] = $passback_params;
    }

    /**
     * 优惠参数
     * 注：仅与支付宝协商后可用
     *
     * @return string
     */
    public function getPromoParams()
    {
        return $this->parameters['promo_params'];
    }

    /**
     * 优惠参数
     * 注：仅与支付宝协商后可用
     * @param array $promo_params
     */
    public function setPromoParams(array $promo_params = null)
    {
        $this->parameters['promo_params'] = $promo_params;
    }

    /**
     * 业务扩展参数
     * @return string
     */
    public function getExtendParams()
    {
        return $this->parameters['extend_params'];
    }

    /**
     * 业务扩展参数
     * @param array $extend_params
     */
    public function setExtendParams(array $extend_params = null)
    {
        $this->parameters['extend_params'] = $extend_params;
    }

    /**
     * 可用渠道，用户只能在指定渠道范围内支付
     * 当有多个渠道时用“,”分隔
     * 注：与disable_pay_channels互斥
     * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.eW2a6y&treeId=193&articleId=105465&docType=1#qdsm
     *
     * @return string
     */
    public function getEnablePayChannels()
    {
        return $this->parameters['enable_pay_channels'];
    }

    /**
     * 可用渠道，用户只能在指定渠道范围内支付
     * 当有多个渠道时用“,”分隔
     * 注：与disable_pay_channels互斥
     *
     * @param string $enable_pay_channels
     */
    public function setEnablePayChannels($enable_pay_channels = null)
    {
        $this->parameters['enable_pay_channels'] = $enable_pay_channels;
    }

    /**
     * 禁用渠道，用户不可用指定渠道支付
     * 当有多个渠道时用“,”分隔
     * 注：与enable_pay_channels互斥
     * @return string
     */
    public function getDisablePayChannels()
    {
        return $this->parameters['disable_pay_channels'];
    }

    /**
     * 禁用渠道，用户不可用指定渠道支付
     * 当有多个渠道时用“,”分隔
     * 注：与enable_pay_channels互斥
     *
     * @param string $disable_pay_channels
     */
    public function setDisablePayChannels($disable_pay_channels = null)
    {
        $this->parameters['disable_pay_channels'] = $disable_pay_channels;
    }

}