<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 16:10
 */

namespace Payment\Wechat\Results;

/**
 * 订单查询结果
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_2
 *
 * @package Payment\Wechat\Results
 *
 * @property string $device_info
 *
 */
class WechatOrderQueryResult extends WechatResult
{
    /**
     * 微信支付分配的终端设备号，
     *
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->getValue('device_info');
    }

    /**
     * 用户在商户appid下的唯一标识
     *
     * @return string
     */
    public function getOpenid()
    {
        return $this->getValue('openid');
    }

    /**
     * 用户是否关注公众账号，Y-关注，N-未关注，仅在公众账号类型支付有效
     *
     * @return bool
     */
    public function getIsSubscribe()
    {
        return $this->getValue('is_subscribe') == 'T';
    }

    /**
     * 调用接口提交的交易类型，取值如下：JSAPI，NATIVE，APP，MICROPAY
     *
     * @return string
     */
    public function getTradeType()
    {
        return $this->getValue('trade_type');
    }

    /**
     * 交易状态
     *
     * SUCCESS—支付成功
     * REFUND—转入退款
     * NOTPAY—未支付
     * CLOSED—已关闭
     * REVOKED—已撤销（刷卡支付）
     * USERPAYING--用户支付中
     * PAYERROR--支付失败(其他原因，如银行返回失败)
     * @return string
     */
    public function getTradeState()
    {
        return $this->getValue('trade_state');
    }

    /**
     * 银行类型，采用字符串类型的银行标识
     *
     * @return string
     */
    public function getBankType()
    {
        return $this->getValue('bank_type');
    }

    /**
     * 订单总金额，单位为分
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
     * 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，
     *
     * @return string
     */
    public function getFeeType()
    {
        return $this->getValue('fee_type');
    }

    /**
     * 现金支付金额订单现金支付金额
     *
     * @return string
     */
    public function getCashFee()
    {
        return $this->getValue('cash_fee');
    }

    /**
     * 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，
     *
     * @return string
     */
    public function getCashFeeType()
    {
        return $this->getValue('cash_fee_type');
    }

    /**
     * 代金券金额
     *
     * “代金券”金额<=订单金额，订单金额-“代金券”金额=现金支付金额，
     *
     * @return string
     */
    public function getCouponFee()
    {
        return $this->getValue('coupon_fee');
    }

    /**
     * 代金券使用数量
     * @return string
     */
    public function getCouponCount()
    {
        return $this->getValue('coupon_count');
    }

    /**
     * 代金券类型
     *
     * CASH--充值代金券
     * NO_CASH---非充值代金券
     * @return array
     */
    public function getCouponTypes()
    {
        return $this->matchValue('coupon_type_');
    }

    /**
     * 代金券ID
     *
     * @return array
     */
    public function getCouponIds()
    {
        return $this->matchValue('coupon_id_');
    }

    /**
     * 单个代金券支付金额
     *
     * @return array
     */
    public function getCouponFees()
    {
        return $this->matchValue('coupon_fee_');
    }

    /**
     * 微信支付订单号
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getValue('transaction_id');
    }

    /**
     *  商户系统的订单号，与请求一致。
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->getValue('out_trade_no');
    }

    /**
     * 附加数据
     * @return string
     */
    public function getAttach()
    {
        return $this->getValue('attach');
    }

    /**
     * 订单支付时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。
     *
     * @return string
     */
    public function getTimeEnd()
    {
        return $this->getValue('time_end');
    }

    /**
     * 对当前查询订单状态的描述和下一步操作的指引
     *
     * @return string
     */
    public function getTradeStateDesc()
    {
        return $this->getValue('trade_state_desc');
    }

}