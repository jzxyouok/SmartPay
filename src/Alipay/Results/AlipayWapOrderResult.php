<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 15:04
 */

namespace Payment\Alipay\Results;


use Payment\Alipay\Notices\AlipayWapNotify;
use Payment\Configuration\PayConfiguration;

/**
 * 手机网页支付同步跳转结果
 *
 * Class AlipayWapOrderResult
 * @package Payment\Alipay\Results
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.i5A1qh&treeId=60&articleId=104790&docType=1#s2
 *
 */
class AlipayWapOrderResult extends AlipayWapNotify
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
     * 该交易在支付宝系统中的交易流水号。最长64位。
     * @return string
     */
    public function getTradeNo()
    {
        return isset($this->requestData['trade_no']) ? $this->requestData['trade_no'] : null;
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
     * 对应请求时的payment_type参数，原样返回。
     * @return string
     */
    public function getPaymentType()
    {
        return isset($this->requestData['payment_type']) ? $this->requestData['payment_type'] : null;
    }

    /**
     * 交易目前所处的状态。
     * 成功状态的值只有两个：
     * TRADE_FINISHED（普通即时到账的交易成功状态）
     * TRADE_SUCCESS（开通了高级即时到账或机票分销产品后的交易成功状态）
     *
     * @return string
     */
    public function getTradeStatus()
    {
        return isset($this->requestData['trade_status']) ? $this->requestData['trade_status'] : null;
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
     * 该笔订单的资金总额，单位为RMB-Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。
     *
     * @return string
     */
    public function getTotalFee()
    {
        return isset($this->requestData['total_fee']) ? $this->requestData['total_fee'] : null;
    }

    /**
     * 对一笔交易的具体描述信息。请求参数原样返回。
     * @return string
     */
    public function getBody()
    {
        return isset($this->requestData['body']) ? $this->requestData['body'] : null;
    }

}