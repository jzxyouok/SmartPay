<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/16 0016
 * Time: 9:12
 */

namespace Payment\Wechat\Results;

/**
 * 退款查询结果
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_5
 *
 * @package Payment\Wechat\Results
 *
 */
class WechatRefundQueryResult extends WechatResult
{
    /**
     * 终端设备号
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
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->getValue('out_trade_no');
    }

    /**
     * 订单总金额，单位为分，只能为整数
     * @return string
     */
    public function getTotalFee()
    {
        return $this->getValue('total_fee');
    }

    /**
     * 应结订单金额=订单金额-非充值代金券金额，应结订单金额<=订单金额。
     *
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
     * 退款记录数
     * @return string
     */
    public function getRefundCount()
    {
        return $this->getValue('refund_count');
    }

    /**
     * 商户退款单号
     * @return array
     */
    public function getOutRefundNo()
    {
        return $this->matchValue('out_refund_no_');
    }

    /**
     * 微信退款单号
     * @return array
     */
    public function getRefundId()
    {
        return $this->matchValue('refund_id_');
    }

    /**
     * 退款渠道
     * ORIGINAL—原路退款
     * BALANCE—退回到余额
     * @return array
     */
    public function getRefundChannel()
    {
        return $this->matchValue('refund_channel_');
    }

    /**
     * 退款总金额,单位为分,可以做部分退款
     * @return array
     */
    public function getRefundFee()
    {
        return $this->matchValue('refund_fee_');
    }

    /**
     * 退款金额=申请退款金额-非充值代金券退款金额，退款金额<=申请退款金额
     * @return array
     */
    public function getSettlementRefundFee()
    {
        return $this->matchValue('settlement_refund_fee_');
    }

    /**
     * 退款资金来源
     *
     * REFUND_SOURCE_RECHARGE_FUNDS---可用余额退款/基本账户
     * REFUND_SOURCE_UNSETTLED_FUNDS---未结算资金退款
     * @return string
     */
    public function getRefundAccount()
    {
        return $this->getValue('refund_account');
    }

    /**
     * 代金券类型
     * CASH--充值代金券
     * NO_CASH---非充值代金券
     * 订单使用代金券时有返回（取值：CASH、NO_CASH）。$n为下标,从0开始编号，举例：coupon_type_$0
     *
     * @return array|null
     */
    public function getCouponType()
    {
        return $this->matchValue('coupon_type_');
    }

    /**
     * 总代金券退款金额
     * 代金券退款金额<=退款金额，退款金额-代金券或立减优惠退款金额为现金
     *
     * @return array
     */
    public function getCouponRefundFee()
    {
        return $this->matchValue('coupon_refund_fee_','/^coupon_refund_fee_[\d]*$/i');
    }

    /**
     * 退款代金券使用数量
     * @return array
     */
    public function getCouponRefundCount()
    {
        return $this->matchValue('coupon_refund_count_');
    }

    /**
     * 退款代金券ID
     * @return array
     */
    public function getCouponRefundId()
    {
        return $this->matchValue('coupon_refund_id_n_m','/^coupon_refund_id_[\d]*_[\d]*$/i');
    }

    /**
     * 单个代金券退款金额
     * @return array
     */
    public function getCouponRefundFees()
    {
        return $this->matchValue('coupon_refund_fee_n_m','/^coupon_refund_fee_[\d]*_[\d]*$/i');
    }

    /**
     * 退款状态：
     * SUCCESS—退款成功
     * FAIL—退款失败
     * PROCESSING—退款处理中
     * CHANGE—转入代发，退款到银行发现用户的卡作废或者冻结了，导致原路退款银行卡失败，资金回流到商户的现金帐号，需要商户人工干预，通过线下或者财付通转账的方式进行退款。
     * @return array
     */
    public function getRefundStatus()
    {
        return $this->matchValue('refund_status_','/^refund_status_[\d]*$/i');
    }

    /**
     * 取当前退款单的退款入账方
     * 1）退回银行卡：
     * {银行名称}{卡类型}{卡尾号}
     * 2）退回支付用户零钱:
     * 支付用户零钱
     *
     * @return array
     */
    public function getRefundRecvAccout()
    {
        return $this->matchValue('refund_recv_accout_','/^refund_recv_accout_[\d]*$/i');
    }

}