<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 17:08
 */

namespace Payment\Wechat\Results;

/**
 * 申请退款订单结果
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_4
 *
 * @package Payment\Wechat\Results
 *
 * @property string $device_info
 *
 */
class WechatRefundResult extends WechatResult
{
    /**
     * 微信支付分配的终端设备号，与下单一致
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->getValue('device_info');
    }

    /**
     * 微信订单号
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getValue('transaction_id');
    }

    /**
     * 商户系统内部的订单号
     * @return string|null
     */
    public function getOutTradeNo()
    {
        return $this->getValue('out_trade_no');
    }

    /**
     * 商户退款单号
     * @return string
     */
    public function getOutRefundNo()
    {
        return $this->getValue('out_refund_no');
    }

    /**
     * 微信退款单号
     * @return string
     */
    public function getRefundId()
    {
        return $this->getValue('refund_id');
    }

    /**
     * 退款渠道
     * ORIGINAL—原路退款
     * BALANCE—退回到余额
     * @return string
     */
    public function getRefundChannel()
    {
        return $this->getValue('refund_channel');
    }

    /**
     * 退款总金额,单位为分,可以做部分退款
     * @return string
     */
    public function getRefundFee()
    {
        return $this->getValue('refund_fee');
    }

    /**
     * 应结退款金额
     *
     * 去掉非充值代金券退款金额后的退款金额，退款金额=申请退款金额-非充值代金券退款金额，退款金额<=申请退款金额
     * @return string
     */
    public function getSettlementRefundFee()
    {
        return $this->getValue('settlement_refund_fee');
    }

    /**
     * 订单总金额，单位为分，只能为整数
     *
     * @return string
     */
    public function getTotalFee()
    {
        return $this->getValue('total_fee');
    }

    /**
     * 应结订单金额
     * 去掉非充值代金券金额后的订单总金额，应结订单金额=订单金额-非充值代金券金额，应结订单金额<=订单金额。
     * @return string
     */
    public function getSettlementTotalFee()
    {
        return $this->getValue('settlement_total_fee');
    }

    /**
     * 订单金额货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY
     * @return string
     */
    public function getFeeType()
    {
        return $this->getValue('fee_type');
    }

    /**
     * 现金支付金额，单位为分，只能为整数
     * @return string
     */
    public function getCashFee()
    {
        return $this->getValue('cash_fee');
    }

    /**
     * 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，
     * @return string
     */
    public function getCashFeeType()
    {
        return $this->getValue('cash_fee_type');
    }

    /**
     * 现金退款金额，单位为分，只能为整数
     * @return string
     */
    public function getCashRefundFee()
    {
        return $this->getValue('cash_refund_fee');
    }

    /**
     * 代金券类型
     *
     * CASH--充值代金券
     * NO_CASH---非充值代金券
     * 订单使用代金券时有返回（取值：CASH、NO_CASH）。$n为下标,从0开始编号，举例：coupon_type_0
     * @return array
     */
    public function getCouponTypes()
    {
        return $this->matchValue('coupon_type_');
    }

    /**
     * 代金券退款总金额
     *
     * 代金券退款金额<=退款金额，退款金额-代金券或立减优惠退款金额为现金
     *
     * @return string
     */
    public function getCouponRefundFee()
    {
        return $this->getValue('coupon_refund_fee');
    }

    /**
     * 代金券退款金额<=退款金额，退款金额-代金券或立减优惠退款金额为现金
     *
     * @return array
     */
    public function getCouponRefundFees()
    {
        return $this->matchValue('coupon_refund_fee_');
    }

    /**
     * 退款代金券使用数量
     *
     * @return string
     */
    public function getCouponRefundCount()
    {
        return $this->getValue('coupon_refund_count');
    }

    /**
     *  退款代金券ID, $n为下标，从0开始编号
     *
     * @return array
     */
    public function getCouponRefundIds()
    {
        return $this->matchValue('coupon_refund_id_');
    }

}