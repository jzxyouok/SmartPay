<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 9:42
 */

namespace Payment\Alipay\Results;

/**
 * 统一收单交易退款接口响应结果
 * @package Payment\Alipay\Results
 *
 */
class AlipayTradeRefundResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_trade_refund_response'];
    }

    /**
     * 支付宝交易号
     *
     * @return string
     */
    public function getTradeNo()
    {
        return array_value('trade_no',$this->responseData);
    }

    /**
     * 商户订单号
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->responseData);
    }

    /**
     * 用户的登录id
     *
     * @return string
     */
    public function getBuyerLogonId()
    {
        return array_value('buyer_logon_id',$this->responseData);
    }

    /**
     * 本次退款是否发生了资金变化
     * @return string
     */
    public function getFundChange()
    {
        return array_value('fund_change',$this->responseData);
    }

    /**
     * 退款总金额
     * @return string
     */
    public function getRefundFee()
    {
        return array_value('refund_fee',$this->responseData);
    }

    /**
     * 	退款支付时间
     * @return string
     */
    public function getGmtRefundPay()
    {
        return array_value('gmt_refund_pay',$this->responseData);
    }

    /**
     * 退款使用的资金渠道
     * fund_channel 交易使用的资金渠道
     * amount 该支付工具类型所使用的金额
     * real_amount 渠道实际付款金额
     * @return array
     */
    public function getRefundDetailItemList()
    {
        return array_value('refund_detail_item_list',$this->responseData);
    }

    /**
     * 交易在支付时候的门店名称
     * @return string
     */
    public function getStoreName()
    {
        return array_value('store_name',$this->responseData);
    }

    /**
     * 买家在支付宝的用户id
     * @return string
     */
    public function getBuyerUserId()
    {
        return array_value('buyer_user_id',$this->responseData);
    }

}