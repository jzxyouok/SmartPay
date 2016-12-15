<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 17:43
 */

namespace Payment\Alipay\Notices;

use Payment\Alipay\AlipayConfiguration;

/**
 * App支付结果异步通知
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.GgUBoh&treeId=193&articleId=105301&docType=1
 * @package Payment\Alipay\Notices
 *
 */
class AlipayTradeOrderNotify extends AlipayTradeNotify
{
    public function __construct(AlipayConfiguration $config)
    {
        parent::__construct($config);
    }

    protected function reply($isSuccess, $message)
    {
        return $isSuccess ? 'true' : 'fail';
    }

    /**
     * 通知的发送时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string
     */
    public function getNotifyTime()
    {
        return array_value('notify_time',$this->data);
    }

    /**
     * 通知的类型
     * @return string
     */
    public function getNotifyType()
    {
        return array_value('notify_type',$this->data);
    }

    /**
     * 通知校验ID
     * @return string
     */
    public function getNotifyId()
    {
        return array_value('notify_id',$this->data);
    }

    /**
     * 支付宝分配给开发者的应用Id
     * @return string
     */
    public function getAppId()
    {
        return array_value('app_id',$this->data);
    }


    /**
     * 编码格式，如utf-8、gbk、gb2312等
     *
     * @return string
     */
    public function getCharset()
    {
        return array_value('charset',$this->data);
    }

    /**
     * 调用的接口版本，固定为：1.0
     * @return string
     */
    public function getVersion()
    {
        return array_value('version',$this->data);
    }

    /**
     * 	支付宝交易凭证号
     * @return string
     */
    public function getTradeNo()
    {
        return array_value('trade_no',$this->data);
    }

    /**
     * 原支付请求的商户订单号
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->data);
    }

    /**
     * 商户业务ID，主要是退款通知中返回退款申请的流水号
     * @return string|null
     */
    public function getOutBizNo()
    {
        return array_value('out_biz_no',$this->data);
    }

    /**
     * 买家支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字
     * @return string|null
     */
    public function getBuyerId()
    {
        return array_value('buyer_id',$this->data);
    }

    /**
     * 买家支付宝账号
     * @return string|null
     */
    public function getBuyerLogonId()
    {
        return array_value('buyer_logon_id',$this->data);
    }

    /**
     * 卖家支付宝用户号
     * @return string|null
     */
    public function getSellerId()
    {
        return array_value('seller_id',$this->data);
    }

    /**
     * 卖家支付宝账号
     * @return string|null
     */
    public function getSellerEmail()
    {
        return array_value('seller_email',$this->data);
    }

    /**
     * 交易目前所处的状态
     * @return string|null
     */
    public function getTradeStatus()
    {
        return array_value('trade_status',$this->data);
    }

    /**
     * 本次交易支付的订单金额，单位为人民币（元）
     * @return string|null
     */
    public function getTotalAmount()
    {
        return array_value('total_amount',$this->data);
    }

    /**
     * 商家在交易中实际收到的款项，单位为元
     * @return string|null
     */
    public function getReceiptAmount()
    {
        return array_value('receipt_amount',$this->data);
    }

    /**
     * 用户在交易中支付的可开发票的金额
     * @return string|null
     */
    public function getInvoiceAmount()
    {
        return array_value('invoice_amount',$this->data);
    }

    /**
     * 用户在交易中支付的金额
     * @return string|null
     */
    public function getBuyerPayAmount()
    {
        return array_value('buyer_pay_amount',$this->data);
    }

    /**
     * 使用集分宝支付的金额
     * @return string|null
     */
    public function getPointAmount()
    {
        return array_value('point_amount',$this->data);
    }

    /**
     * 退款通知中，返回总退款金额，单位为元，支持两位小数
     * @return string|null
     */
    public function getRefundFee()
    {
        return array_value('refund_fee',$this->data);
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等，是请求时对应的参数，原样通知回来
     * @return string|null
     */
    public function getSubject()
    {
        return array_value('subject',$this->data);
    }

    /**
     * 	该订单的备注、描述、明细等。对应请求时的body参数，原样通知回来
     * @return string|null
     */
    public function getBody()
    {
        return array_value('body',$this->data);
    }

    /**
     * 该笔交易创建的时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string|null
     */
    public function getGmtCreate()
    {
        return array_value('gmt_create',$this->data);
    }

    /**
     * 该笔交易的买家付款时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string|null
     */
    public function getGmtPayment()
    {
        return array_value('gmt_payment',$this->data);
    }

    /**
     * 该笔交易的退款时间。格式为yyyy-MM-dd HH:mm:ss.S
     * @return string|null
     */
    public function getGmtRefund()
    {
        return array_value('gmt_refund',$this->data);
    }

    /**
     * 	该笔交易结束时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string|null
     */
    public function getGmtClose()
    {
        return array_value('gmt_close',$this->data);
    }

    /**
     * 支付成功的各个渠道金额信息
     * @return array|null
     */
    public function getFundBillList()
    {
        return array_value('fund_bill_list',$this->data);
    }

    /**
     * 公共回传参数，如果请求时传递了该参数，则返回给商户时会在异步通知时将该参数原样返回。本参数必须进行UrlEncode之后才可以发送给支付宝
     *
     * @return string|null
     */
    public function getPassbackParams()
    {
        return array_value('passback_params',$this->data);
    }

    /**
     * 本交易支付时所使用的所有优惠券信息
     * @return array|null
     */
    public function getVoucherDetailList()
    {
        return array_value('voucher_detail_list',$this->data);
    }

}
