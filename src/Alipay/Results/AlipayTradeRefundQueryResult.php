<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 10:22
 */

namespace Payment\Alipay\Results;

/**
 * 统一收单交易退款查询返回结果
 *
 * @package Payment\Alipay\Results
 *
 */
class AlipayTradeRefundQueryResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_trade_fastpay_refund_query_response'];
    }

    /**
     * 支付宝交易号
     * @return string
     */
    public function getTradeNo()
    {
        return array_value('trade_no',$this->responseData);
    }

    /**
     * 创建交易传入的商户订单号
     * @return string
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->responseData);
    }

    /**
     * 本笔退款对应的退款请求号
     * @return string
     */
    public function getOutRequestNo()
    {
        return array_value('out_request_no',$this->responseData);
    }

    /**
     * 	发起退款时，传入的退款原因
     * @return string
     */
    public function getRefundReason()
    {
        return array_value('refund_reason',$this->responseData);
    }

    /**
     * 该笔退款所对应的交易的订单金额
     * @return string
     */
    public function getTotalAmount()
    {
        return array_value('total_amount',$this->responseData);
    }

    /**
     * 本次退款请求，对应的退款金额
     * @return string
     */
    public function getRefundAmount()
    {
        return array_value('refund_amount',$this->responseData);
    }

}