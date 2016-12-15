<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 9:59
 */

namespace Payment\Alipay;

/**
 * 交易状态说明
 * @package Payment\Alipay
 */
class AlipayTradeStatus
{
    /**
     * 交易创建，等待买家付款
     */
    const WAIT_BUYER_PAY = 'WAIT_BUYER_PAY';
    /**
     * 未付款交易超时关闭，或支付完成后全额退款
     */
    const TRADE_CLOSED  =   'TRADE_CLOSED';
    /**
     * 	交易支付成功
     */
    const TRADE_SUCCESS ='TRADE_SUCCESS';
    /**
     * 	交易结束，不可退款
     */
    const TRADE_FINISHED = 'TRADE_FINISHED';
}