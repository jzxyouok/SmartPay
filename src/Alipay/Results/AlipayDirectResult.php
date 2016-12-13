<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 10:48
 */

namespace Payment\Alipay\Results;


use Payment\Alipay\Notices\AlipayWapNotify;
use Payment\Configuration\PayConfiguration;

/**
 * 即时到账交易接口 页面跳转同步参数说明
 *
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.nfrT1f&treeId=108&articleId=104743&docType=1#s2
 *
 * @package Payment\Alipay\Results
 */
class AlipayDirectResult extends AlipayWapNotify
{
    public function __construct(PayConfiguration $config)
    {
        parent::__construct($config);
    }

    /**
     * 表示接口调用是否成功，并不表明业务处理结果。
     *
     * @return string
     */
    public function getIsSuccess()
    {
        return isset($this->requestData['is_success']) ? $this->requestData['is_success'] : null;
    }

    /**
     * DSA、RSA、MD5三个值可选，必须大写。
     *
     * @return string
     */
    public function getSignType()
    {
        return isset($this->requestData['sign_type']) ? $this->requestData['sign_type'] : null;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return isset($this->requestData['sign']) ? $this->requestData['sign'] : null;
    }

    /**
     * 对应商户网站的订单系统中的唯一订单号，非支付宝交易号。需保证在商户网站中的唯一性。是请求时对应的参数，原样返回。
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return isset($this->requestData['out_trade_no']) ? $this->requestData['out_trade_no'] : null;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     *
     * @return string
     */
    public function getSubject()
    {
        return isset($this->requestData['subject']) ? $this->requestData['subject'] : null;
    }

    /**
     * 只支持取值为1（商品购买）。
     *
     * @return string
     */
    public function getPaymentType()
    {
        return isset($this->requestData['payment_type']) ? $this->requestData['payment_type'] : null;
    }

    /**
     * 	标志调用哪个接口返回的链接。
     *
     * @return string
     */
    public function getExterface()
    {
        return isset($this->requestData['exterface']) ? $this->requestData['exterface'] : null;
    }

    /**
     * 该交易在支付宝系统中的交易流水号。最长64位。
     *
     * @return string
     */
    public function getTradeNo()
    {
        return isset($this->requestData['trade_no']) ? $this->requestData['trade_no'] : null;
    }

    /**
     * 交易目前所处的状态。成功状态的值只有两个：
     *
     * TRADE_FINISHED（普通即时到账的交易成功状态）；
     * TRADE_SUCCESS（开通了高级即时到账或机票分销产品后的交易成功状态）
     *
     * @return string
     */
    public function getTradeStatus()
    {
        return isset($this->requestData['trade_status']) ? $this->requestData['trade_status'] : null;
    }

    /**
     * 支付宝通知校验ID，商户可以用这个流水号询问支付宝该条通知的合法性。
     *
     * @return string
     */
    public function getNotifyId()
    {
        return isset($this->requestData['notify_id']) ? $this->requestData['notify_id'] : null;
    }

    /**
     * 通知时间（支付宝时间）。格式为yyyy-MM-dd HH:mm:ss。
     *
     * @return string
     */
    public function getNotifyTime()
    {
        return isset($this->requestData['notify_time']) ? $this->requestData['notify_time'] : null;
    }

    /**
     * 	返回通知类型。
     *
     * @return string
     */
    public function getNotifyType()
    {
        return isset($this->requestData['notify_type']) ? $this->requestData['notify_type'] : null;
    }

    /**
     * 	卖家支付宝账号，可以是Email或手机号码。
     *
     * @return string
     */
    public function getSellerEmail()
    {
        return isset($this->requestData['seller_email']) ? $this->requestData['seller_email'] : null;
    }

    /**
     * 买家支付宝账号，可以是Email或手机号码。
     *
     * @return string
     */
    public function getBuyerEmail()
    {
        return isset($this->requestData['buyer_email']) ? $this->requestData['buyer_email'] : null;
    }

    /**
     * 卖家支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。
     *
     * @return string
     */
    public function getSellerId()
    {
        return isset($this->requestData['seller_id']) ? $this->requestData['seller_id'] : null;
    }

    /**
     * 买家支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。
     *
     * @return string
     */
    public function getBuyerId()
    {
        return isset($this->requestData['buyer_id']) ? $this->requestData['buyer_id'] : null;
    }

    /**
     * 该笔订单的资金总额，单位为RMB-Yuan。取值范围为[0.01,100000000.00]，精确到小数点后两位。
     *
     * @return string
     */
    public function getTotalFee()
    {
        return isset($this->requestData['total_fee']) ? $this->requestData['total_fee'] : null;
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     *
     * @return string
     */
    public function getBody()
    {
        return isset($this->requestData['body']) ? $this->requestData['body'] : null;
    }

    /**
     * 用于商户回传参数，该值不能包含“=”、“&”等特殊字符。如果用户请求时传递了该参数，则返回给商户时会回传该参数。
     *
     * @return string
     */
    public function getExtraCommonParam()
    {
        return isset($this->requestData['extra_common_param']) ? $this->requestData['extra_common_param'] : null;
    }



}