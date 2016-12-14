<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 10:58
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\ReverseParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单交易撤销接口
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.PlTwKb&apiId=866&docType=4
 *
 * 支付交易返回失败或支付系统超时，调用该接口撤销交易。
 * 如果此订单用户支付失败，支付宝系统会将此订单关闭；如果用户支付成功，支付宝系统会将此订单资金退还给用户。
 * 注意：只有发生支付系统超时或者支付结果未知时可调用撤销，其他正常支付的单如需实现相同功能请调用申请退款API。
 * 提交支付交易后调用【查询订单API】，没有明确的支付结果再调用【撤销订单API】。
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeCancelParameter extends ReverseParameter
{
    protected $method = 'alipay.trade.cancel';
    use AlipayParameterTrait;
    protected $parameters = [
        'out_trade_no'  => null,
        'trade_no'      => null
    ];

    protected function checkDataParams()
    {
        if(empty($this->parameters['out_trade_no']) && empty($this->parameters['trade_no'])){
            throw new PaymentException('out_trade_no 和 trade_no 不能同时为空');
        }
    }

    /**
     * 	原支付请求的商户订单号,和支付宝交易号不能同时为空
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 	原支付请求的商户订单号,和支付宝交易号不能同时为空
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
    }

    /**
     * 支付宝交易号，和商户订单号不能同时为空
     * @return string
     */
    public function getTradeNo()
    {
        return $this->parameters['trade_no'];
    }

    /**
     * 支付宝交易号，和商户订单号不能同时为空
     * @param string $trade_no
     */
    public function setTradeNo($trade_no)
    {
        $this->parameters['trade_no'] = $trade_no;
    }


}