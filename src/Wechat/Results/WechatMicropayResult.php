<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/16 0016
 * Time: 10:54
 */

namespace Payment\Wechat\Results;

/**
 * 提交刷卡支付API返回结果
 * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_10&index=1
 * @package Payment\Wechat\Results
 *
 */
class WechatMicropayResult extends WechatResult
{
    /**
     * 调用接口提交的终端设备号
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->getValue('device_info');
    }

    /**
     *  用户在商户appid 下的唯一标识
     * @return string
     */
    public function getOpenid()
    {
        return $this->getValue('openid');
    }

    /**
     * 用户是否关注公众账号，仅在公众账号类型支付有效，取值范围：Y或N;Y-关注;N-未关注
     * @return string
     */
    public function getIsSubscribe()
    {
        return $this->getValue('is_subscribe');
    }

    /**
     * 支付类型为MICROPAY(即扫码支付)
     * @return string
     */
    public function getTradeType()
    {
        return $this->getValue('trade_type');
    }

    /**
     * 银行类型，采用字符串类型的银行标识
     * @return string
     */
    public function getBankType()
    {
        return $this->getValue('bank_type');
    }

    /**
     * 货币类型 符合ISO 4217标准的三位字母代码，默认人民币：CNY
     * @return string
     */
    public function getFeeType()
    {
        return $this->getValue('fee_type');
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
     * 应结订单金额=订单金额-非充值代金券金额，应结订单金额<=订单金额
     * @return string
     */
    public function getSettlementTotalFee()
    {
        return $this->getValue('settlement_total_fee');
    }

    /**
     * 代金券金额 “代金券”金额<=订单金额，订单金额-“代金券”金额=现金支付金额
     * @return string
     */
    public function getCouponFee()
    {
        return $this->getValue('coupon_fee');
    }

    /**
     * 现金支付货币类型 符合ISO 4217标准的三位字母代码，默认人民币：CNY
     * @return string
     */
    public function getCashFeeType()
    {
        return $this->getValue('cash_fee_type');
    }

    /**
     * 订单现金支付金额
     * @return string
     */
    public function getCashFee()
    {
        return $this->getValue('cash_fee');
    }

    /**
     * 微信支付订单号
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getValue('transaction_id');
    }

    /**
     * 商户系统的订单号，与请求一致
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->getValue('out_trade_no');
    }

    /**
     * 商家数据包，原样返回
     * @return string
     */
    public function getAttach()
    {
        return $this->getValue('attach');
    }

    /**
     * 订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010
     * @return string
     */
    public function getTimeEnd()
    {
        return $this->getValue('time_end');
    }

}