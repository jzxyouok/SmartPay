<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 16:01
 */

namespace Payment\Alipay\Notices;

/**
 * 当面付异步通知-仅用于扫码支付
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.cbXrHG&treeId=193&articleId=103296&docType=1#
 *
 * @package Payment\Alipay\Notices
 *
 */
class AlipayTradeQrCodeNotity extends AlipayTradeNotify
{
    protected function reply($isSuccess, $message)
    {
        return $isSuccess ? 'true' : 'fail';
    }

    /**
     * 通知的发送时间。格式为yyyy-MM-dd HH:mm:ss
     *
     * @return string
     */
    public function getNotifyTime()
    {
        return $this->notify_time;
    }

    /**
     * 通知的类型
     *
     * @return string
     */
    public function getNotifyType()
    {
        return $this->notify_type;
    }

    /**
     * 	通知校验ID
     *
     * @return string
     */
    public function getNotifyId()
    {
        return $this->notify_id;
    }

    /**
     * 	支付宝交易凭证号
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->trade_no;
    }

    /**
     * 支付宝分配给开发者的应用Id
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * 原支付请求的商户订单号
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户业务ID，主要是退款通知中返回退款申请的流水号
     * @return string
     */
    public function getOutBizNo()
    {
        return $this->out_biz_no;
    }

    /**
     * 买家支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字
     * @return string
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * 	买家支付宝账号
     * @return string
     */
    public function getBuyerLogonId()
    {
        return $this->buyer_logon_id;
    }

    /**
     * 	卖家支付宝用户号
     * @return string
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }

    /**
     * 	卖家支付宝账号
     * @return string
     */
    public function getSellerEmail()
    {
        return $this->seller_email;
    }

    /**
     * 交易目前所处的状态
     * @return string
     */
    public function getTradeStatus()
    {
        return $this->trade_status;
    }

    /**
     * 	本次交易支付的订单金额，单位为人民币（元）
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * 商家在交易中实际收到的款项，单位为元
     * @return string
     */
    public function getReceiptAmount()
    {
        return $this->receipt_amount;
    }

    /**
     * 用户在交易中支付的可开发票的金额
     * @return string
     */
    public function getInvoiceAmount()
    {
        return $this->invoice_amount;
    }

    /**
     * 用户在交易中支付的金额
     * @return string
     */
    public function getBuyerPayAmount()
    {
        return $this->buyer_pay_amount;
    }

    /**
     * 使用集分宝支付的金额
     * @return string
     */
    public function getPointAmount()
    {
        return $this->point_amount;
    }

    /**
     * 退款通知中，返回总退款金额，单位为元，支持两位小数
     * @return string
     */
    public function getRefundFee()
    {
        return $this->refund_fee;
    }

    /**
     * 商户实际退款给用户的金额，单位为元，支持两位小数
     * @return string
     */
    public function getSendBackFee()
    {
        return $this->send_back_fee;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等，是请求时对应的参数，原样通知回来
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * 该订单的备注、描述、明细等。对应请求时的body参数，原样通知回来
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * 该笔交易创建的时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string
     */
    public function getGmtCreate()
    {
        return $this->gmt_create;
    }

    /**
     * 该笔交易的买家付款时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string
     */
    public function getGmtPayment()
    {
        return $this->gmt_payment;
    }

    /**
     * 该笔交易的退款时间。格式为yyyy-MM-dd HH:mm:ss.S
     * @return string
     */
    public function getGmtRefund()
    {
        return $this->gmt_refund;
    }

    /**
     * 该笔交易结束时间。格式为yyyy-MM-dd HH:mm:ss
     * @return string
     */
    public function getGmtClose()
    {
        return $this->gmt_close;
    }

    /**
     * 支付成功的各个渠道金额信息
     * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.cbXrHG&treeId=193&articleId=103296&docType=1#s1
     *
     * @return string
     */
    public function getFundBillList()
    {
        return $this->fund_bill_list;
    }

}