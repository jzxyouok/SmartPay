<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 11:06
 */

namespace Payment\Alipay\Results;

/**
 * 统一收单交易撤销接口返回数据结果
 *
 * @package Payment\Alipay\Results
 */
class AlipayTradeCancelResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_trade_cancel_response'];
    }

    /**
     * 支付宝交易号
     * @return string
     */
    public function getTradeNo()
    {
        return array_value('trade_no',$this->responseData);
    }

    /**
     * 	商户订单号
     * @return string
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->responseData);
    }

    /**
     * 是否需要重试
     * @return string
     */
    public function getRetryFlag()
    {
        return array_value('retry_flag',$this->responseData);
    }

    /**
     * 本次撤销触发的交易动作 close：关闭交易，无退款 refund：产生了退款
     *
     * @return string
     */
    public function getAction()
    {
        return array_value('action',$this->responseData);
    }

}