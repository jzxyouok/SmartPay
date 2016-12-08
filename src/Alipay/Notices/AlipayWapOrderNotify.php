<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 13:45
 */

namespace Payment\Alipay\Notices;


use Payment\Configuration\PayConfiguration;

/**
 * 支付宝手机支付通知结果
 *
 * @link  https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.i5A1qh&treeId=60&articleId=104790&docType=1
 *
 * Class AlipayWapOrderNotify
 * @package Payment\Alipay\Notices
 *
 */
class AlipayWapOrderNotify extends AlipayWapNotify
{
    public function __construct(PayConfiguration $config)
    {
        parent::__construct($config);
    }

    /**
     * 对应商户网站的订单系统中的唯一订单号，非支付宝交易号。
     * 需保证在商户网站中的唯一性。是请求时对应的参数，原样返回。
     * @return string
     */
    public function getOutTradeNo()
    {
        return isset($this->requestData['out_trade_no']) ? $this->requestData['out_trade_no'] : null;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     * @return string
     */
    public function getSubject()
    {
        return isset($this->requestData['subject']) ? $this->requestData['subject'] : null;
    }

    /**
     * 对应请求时的payment_type参数，原样返回。
     * @return string
     */
    public function getPaymentType()
    {
        return isset($this->requestData['payment_type']) ? $this->requestData['payment_type'] : null;
    }

    /**
     * 该交易在支付宝系统中的交易流水号。最长64位。
     * @return string
     */
    public function getTradeNo()
    {
        return isset($this->requestData['trade_no']) ? $this->requestData['trade_no'] : null;
    }

    /**
     * 取值范围请参见 @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.i5A1qh&treeId=60&articleId=104790&docType=1#s6
     * @return string
     */
    public function getTradeStatus()
    {
        return isset($this->requestData['trade_status']) ? $this->requestData['trade_status'] : null;
    }

    /**
     * 该笔交易创建的时间。
     * 格式为yyyy-MM-dd
     * HH:mm:ss。
     * @return string
     */
    public function getGmtCreate()
    {
        return isset($this->requestData['gmt_create']) ? $this->requestData['gmt_create'] : null;
    }

    /**
     * 该笔交易的买家付款时间。
     * 格式为yyyy-MM-dd HH:mm:ss。
     * @return string
     */
    public function getGmtPayment()
    {
        return isset($this->requestData['gmt_payment']) ? $this->requestData['gmt_payment'] : null;
    }

    /**
     * 交易关闭时间。
     * 格式为yyyy-MM-dd HH:mm:ss。
     * @return string
     */
    public function getGmtClose()
    {
        return isset($this->requestData['gmt_close']) ? $this->requestData['gmt_close'] : null;
    }

    /**
     * 买家支付宝账号，可以是Email或手机号码。
     * @return string
     */
    public function getSellerEmail()
    {
        return isset($this->requestData['seller_email']) ? $this->requestData['seller_email'] : null;
    }

    /**
     *
     * 买家支付宝账号，可以是Email或手机号码。
     * @return string
     */
    public function getBuyerEmail()
    {
        return isset($this->requestData['buyer_email']) ? $this->requestData['buyer_email'] : null;
    }

    /**
     * 卖家支付宝账号对应的支付宝唯一用户号。
     * 以2088开头的纯16位数字。
     * @return string
     */
    public function getSellerId()
    {
        return isset($this->requestData['seller_id']) ? $this->requestData['seller_id'] : null;
    }

    /**
     * 买家支付宝账号对应的支付宝唯一用户号。
     * 以2088开头的纯16位数字。
     * @return string
     */
    public function getBuyerId()
    {
        return isset($this->requestData['buyer_id']) ? $this->requestData['buyer_id'] : null;
    }

    /**
     * 商品单价
     *
     * 如果请求时使用的是total_fee，那么price等于total_fee；如果请求时传了price，那么对应请求时的price参数，原样通知回来。
     * @return string
     */
    public function getPrice()
    {
        return isset($this->requestData['price']) ? $this->requestData['price'] : null;
    }

    /**
     * 该笔订单的总金额。
     * 请求时对应的参数，原样通知回来。
     * @return string
     */
    public function getTotalFee()
    {
        return isset($this->requestData['total_fee']) ? $this->requestData['total_fee'] : null;
    }

    /**
     *
     * 购买数量
     *
     * 如果请求时使用的是total_fee，那么quantity等于1；如果请求时有传quantity，那么对应请求时的quantity参数，原样通知回来。
     * @return string
     */
    public function getQuantity()
    {
        return isset($this->requestData['quantity']) ? $this->requestData['quantity'] : null;
    }

    /**
     * 该笔订单的备注、描述、明细等。
     * 对应请求时的body参数，原样通知回来。
     * @return string
     */
    public function getBody()
    {
        return isset($this->requestData['body']) ? $this->requestData['body'] : null;
    }

    /**
     * 支付宝系统会把discount的值加到交易金额上，如果需要折扣，本参数为负数。
     * @return string
     */
    public function getDiscount()
    {
        return isset($this->requestData['discount']) ? $this->requestData['discount'] : null;
    }

    /**
     * 该交易是否调整过价格。
     * @return string
     */
    public function getIsTotalFeeAdjust()
    {
        return isset($this->requestData['is_total_fee_adjust']) ? $this->requestData['is_total_fee_adjust'] : null;
    }

    /**
     * 是否在交易过程中使用了红包。
     * @return string
     */
    public function getUseCoupon()
    {
        return isset($this->requestData['use_coupon']) ? $this->requestData['use_coupon'] : null;
    }

    /**
     * 退款状态
     * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.i5A1qh&treeId=60&articleId=104790&docType=1#s7
     *
     * @return string
     */
    public function getRefundStatus()
    {
        return isset($this->requestData['refund_status']) ? $this->requestData['refund_status'] : null;
    }

    /**
     * 卖家退款的时间，退款通知时会发送。
     * 格式为yyyy-MM-dd HH:mm:ss。
     *
     * @return string
     */
    public function getGmtRefund()
    {
        return isset($this->requestData['gmt_refund']) ? $this->requestData['gmt_refund'] : null;
    }

}