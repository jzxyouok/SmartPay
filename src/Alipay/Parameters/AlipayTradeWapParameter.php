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

    protected function buildData()
    {
        // TODO: Implement buildData() method.
    }

    protected function checkDataParams()
    {
        // TODO: Implement checkDataParams() method.
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     * @param string $body
     */
    public function setBody($body = null)
    {
        $this->body = $body;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     *
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * 商户网站唯一订单号
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户网站唯一订单号
     *
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
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
        return $this->timeout_express;
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
        $this->timeout_express = $timeout_express;
    }

    /**
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * @param string $total_amount
     */
    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return string
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }

    /**
     * @param string $seller_id
     */
    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * @param string $auth_token
     */
    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->product_code;
    }

    /**
     * @param string $product_code
     */
    public function setProductCode($product_code)
    {
        $this->product_code = $product_code;
    }

    /**
     * @return string
     */
    public function getGoodsType()
    {
        return $this->goods_type;
    }

    /**
     * @param string $goods_type
     */
    public function setGoodsType($goods_type)
    {
        $this->goods_type = $goods_type;
    }

    /**
     * @return string
     */
    public function getPassbackParams()
    {
        return $this->passback_params;
    }

    /**
     * @param string $passback_params
     */
    public function setPassbackParams($passback_params)
    {
        $this->passback_params = $passback_params;
    }

    /**
     * @return string
     */
    public function getPromoParams()
    {
        return $this->promo_params;
    }

    /**
     * @param string $promo_params
     */
    public function setPromoParams($promo_params)
    {
        $this->promo_params = $promo_params;
    }

    /**
     * @return string
     */
    public function getExtendParams()
    {
        return $this->extend_params;
    }

    /**
     * @param string $extend_params
     */
    public function setExtendParams($extend_params)
    {
        $this->extend_params = $extend_params;
    }

    /**
     * @return string
     */
    public function getEnablePayChannels()
    {
        return $this->enable_pay_channels;
    }

    /**
     * @param string $enable_pay_channels
     */
    public function setEnablePayChannels($enable_pay_channels)
    {
        $this->enable_pay_channels = $enable_pay_channels;
    }

    /**
     * @return string
     */
    public function getDisablePayChannels()
    {
        return $this->disable_pay_channels;
    }

    /**
     * @param string $disable_pay_channels
     */
    public function setDisablePayChannels($disable_pay_channels)
    {
        $this->disable_pay_channels = $disable_pay_channels;
    }


}