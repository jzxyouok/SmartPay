<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:16
 */

namespace Payment\Alipay;

use Payment\AbstractPaymentProvider;
use Payment\Alipay\Parameters\AlipayWapOrderParameter;
use Payment\Parameters\AbstractParameter;
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
class AlipayTradePaymentProvider extends AbstractPaymentProvider
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

    }

    public function micropay(TradeParameter $parameter)
    {
        $url = $this->config->get('alipay_url');

        $parameter->sign();

        $data = http_build_query($parameter->getRequestData());

        $header['content-type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8');

        $result = $this->post($data,$url,30,null,$header);

        return $result;
    }

    public function unifiedOrder(PreOrderParameter $parameter)
    {
        $url = $this->config->get('alipay_url');

        $data = http_build_query($parameter->getRequestData());

        $header['content-type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8');

        $result = $this->post($data,$url,30,null,$header);

        return $result;
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

    public function handle(AbstractParameter $parameter)
    {
        if($parameter instanceof AlipayWapOrderParameter){
            $parameter->sign();

            print_r($parameter->getRequestData());
            exit;
            return AlipayWapOrderParameter::ALIPAY_GATEWAY . '?' . http_build_query($parameter->getRequestData());
        }
        return null;
    }
}