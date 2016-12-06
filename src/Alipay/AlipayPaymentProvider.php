<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:16
 */

namespace Payment\Alipay;

use Payment\AbstractPaymentProvider;
use Payment\Parameters\AppParameter;
use Payment\Parameters\BillParameter;
use Payment\Parameters\CloseOrderParameter;
use Payment\Parameters\OrderParameter;
use Payment\Parameters\PreOrderParameter;
use Payment\Parameters\QrCodeParameter;
use Payment\Parameters\QueryOrderParameter;
use Payment\Parameters\RefundParameter;
use Payment\Parameters\RefundQueryParameter;
use Payment\Parameters\ReportParameter;
use Payment\Parameters\ReverseParameter;
use Payment\Parameters\TradeParameter;

/**
 * 支付宝接口实现
 * Class AlipayPaymentProvider
 * @package Payment\Alipay
 */
class AlipayPaymentProvider extends AbstractPaymentProvider
{
    public function createAppSign(AppParameter $parameter)
    {
        // TODO: Implement createAppSign() method.
    }

    public function createQrCode(QrCodeParameter $parameter)
    {
        // TODO: Implement createQrCode() method.
    }

    public function createOrder(OrderParameter $parameter)
    {
        // TODO: Implement createOrder() method.
    }

    public function micropay(TradeParameter $parameters)
    {
        // TODO: Implement micropay() method.
    }

    public function unifiedOrder(PreOrderParameter $parameters)
    {
        // TODO: Implement unifiedOrder() method.
    }

    public function queryOrder(QueryOrderParameter $parameters)
    {
        // TODO: Implement queryOrder() method.
    }

    public function closeOrder(CloseOrderParameter $parameters)
    {
        // TODO: Implement closeOrder() method.
    }

    public function refund(RefundParameter $parameters)
    {
        // TODO: Implement refund() method.
    }

    public function refundQuery(RefundQueryParameter $parameters)
    {
        // TODO: Implement refundQuery() method.
    }

    public function queryBill(BillParameter $parameters)
    {
        // TODO: Implement queryBill() method.
    }

    protected function report(ReportParameter $parameters)
    {
        // TODO: Implement report() method.
    }

    public function reverse(ReverseParameter $parameter)
    {
        // TODO: Implement reverse() method.
    }

}