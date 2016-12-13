<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 16:14
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\QueryOrderParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单线下交易查询
 *
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=757&docType=4
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeQueryParameter extends QueryOrderParameter
{
    protected $method = 'alipay.trade.query';
    use AlipayParameterTrait;

    protected $parameters = [
        'out_trade_no'  => null,
        'trade_no'      => null
    ];


    /**
     * 订单支付时传入的商户订单号,和支付宝交易号不能同时为空。 trade_no,out_trade_no如果同时存在优先取trade_no
     * @return string|null
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 订单支付时传入的商户订单号,和支付宝交易号不能同时为空。 trade_no,out_trade_no如果同时存在优先取trade_no
     * @param $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
        return $this;
    }

    /**
     * 支付宝交易号，和商户订单号不能同时为空
     * @return string|null
     */
    public function getTradeNo()
    {
        return $this->parameters['trade_no'];
    }

    /**
     * 支付宝交易号，和商户订单号不能同时为空
     * @param $trade_no
     * @return $this
     */
    public function setTradeNo($trade_no)
    {
        $this->parameters['trade_no'] = $trade_no;
        return $this;
    }

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
    }

}