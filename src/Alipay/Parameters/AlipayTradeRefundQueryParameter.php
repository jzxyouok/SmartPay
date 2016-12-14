<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 10:04
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\RefundQueryParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单交易退款查询
 *
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?docType=4&apiId=1049
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeRefundQueryParameter extends RefundQueryParameter
{
    protected $method = 'alipay.trade.fastpay.refund.query';
    use AlipayParameterTrait;
    protected $parameters = [
        'trade_no',
        'out_trade_no',
        'out_request_no'
    ];

    protected function buildData()
    {
        $this->parameter->checkParams();

        $data = $this->parameter->getData();

        $params = [];

        foreach ($this->parameters as $key=>$value){
            if(empty($value)===false){
                $params[$key] = $value;
            }
        }

        $data['biz_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        $this->requestData = $data;
    }

    protected function checkDataParams()
    {
        if(empty($this->parameters['out_trade_no']) && empty($this->parameters['trade_no'])){
            throw new PaymentException('out_trade_no 和 trade_no 不能同时为空');
        }
        if(empty($this->parameters['out_request_no'])){
            throw new PaymentException('退款请求号不能为空： out_request_no');
        }
    }

    /**
     * 支付宝交易号，和商户订单号不能同时为空
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->parameters['trade_no'];
    }

    /**
     * 支付宝交易号，和商户订单号不能同时为空
     *
     * @param string $trade_no
     * @return $this
     */
    public function setTradeNo($trade_no)
    {
        $this->parameters['trade_no'] = $trade_no;
        return $this;
    }

    /**
     * 订单支付时传入的商户订单号,和支付宝交易号不能同时为空。 trade_no,out_trade_no如果同时存在优先取trade_no
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 订单支付时传入的商户订单号,和支付宝交易号不能同时为空。 trade_no,out_trade_no如果同时存在优先取trade_no
     * @param string $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
        return $this;
    }

    /**
     * 请求退款接口时，传入的退款请求号，如果在退款请求时未传入，则该值为创建交易时的外部交易号
     * @return string
     */
    public function getOutRequestNo()
    {
        return $this->parameters['out_request_no'];
    }

    /**
     * 请求退款接口时，传入的退款请求号，如果在退款请求时未传入，则该值为创建交易时的外部交易号
     * @param string $out_request_no
     * @return $this
     */
    public function setOutRequestNo($out_request_no)
    {
        $this->parameters['out_request_no'] = $out_request_no;
        return $this;
    }

}