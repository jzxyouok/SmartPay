<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 9:24
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\RefundParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单交易退款接口
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=759&docType=4
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeRefundParameter extends RefundParameter
{
    /**
     * @var string 接口名称
     */
    protected $method = 'alipay.trade.refund';
    use AlipayParameterTrait;
    protected $parameters =[
        'out_trade_no'  => null,
        'trade_no'      => null,
        'refund_amount' => null,
        'refund_reason' => null,
        'out_request_no'    => null,
        'operator_id'   => null,
        'store_id'      => null,
        'terminal_id'   => null
    ];

    protected function checkDataParams()
    {
        if(empty($this->parameters['out_trade_no']) && empty($this->parameters['trade_no'])){
            throw new PaymentException('out_trade_no 和 trade_no 不能同时为空');
        }
        if(empty($this->parameters['refund_amount'])){
            throw new PaymentException('退款金额不能为空： refund_amount');
        }
    }

    /**
     * 订单支付时传入的商户订单号,不能和 trade_no同时为空。
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 订单支付时传入的商户订单号,不能和 trade_no同时为空。
     *
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
    }

    /**
     * 	支付宝交易号，和商户订单号不能同时为空
     * @return string
     */
    public function getTradeNo()
    {
        return $this->parameters['trade_no'];
    }

    /**
     * 	支付宝交易号，和商户订单号不能同时为空
     * @param string $trade_no
     */
    public function setTradeNo($trade_no)
    {
        $this->parameters['trade_no'] = $trade_no;
    }

    /**
     * 需要退款的金额，该金额不能大于订单金额,单位为元，支持两位小数
     * @return string
     */
    public function getRefundAmount()
    {
        return $this->parameters['refund_amount'];
    }

    /**
     * 需要退款的金额，该金额不能大于订单金额,单位为元，支持两位小数
     * @param string $refund_amount
     */
    public function setRefundAmount($refund_amount)
    {
        $this->parameters['refund_amount'] = $refund_amount;
    }

    /**
     * 退款的原因说明
     * @return string
     */
    public function getRefundReason()
    {
        return $this->parameters['refund_reason'];
    }

    /**
     * 退款的原因说明
     * @param string $refund_reason
     */
    public function setRefundReason($refund_reason = null)
    {
        $this->parameters['refund_reason'] = $refund_reason;
    }

    /**
     * 标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
     * @return string
     */
    public function getOutRequestNo()
    {
        return $this->parameters['out_request_no'];
    }

    /**
     * 标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
     * @param string $out_request_no
     */
    public function setOutRequestNo($out_request_no)
    {
        $this->parameters['out_request_no'] = $out_request_no;
    }

    /**
     * 商户的操作员编号
     * @return string
     */
    public function getOperatorId()
    {
        return $this->parameters['operator_id'];
    }

    /**
     * 商户的操作员编号
     * @param string $operator_id
     */
    public function setOperatorId($operator_id = null)
    {
        $this->parameters['operator_id'] = $operator_id;
    }

    /**
     * 	商户的门店编号
     * @return string
     */
    public function getStoreId()
    {
        return $this->parameters['store_id'];
    }

    /**
     * 	商户的门店编号
     * @param string $store_id
     */
    public function setStoreId($store_id = null)
    {
        $this->parameters['store_id'] = $store_id;
    }

    /**
     * 商户的终端编号
     * @return string
     */
    public function getTerminalId()
    {
        return $this->parameters['terminal_id'];
    }

    /**
     * 商户的终端编号
     * @param string $terminal_id
     */
    public function setTerminalId($terminal_id = null)
    {
        $this->parameters['terminal_id'] = $terminal_id;
    }


}