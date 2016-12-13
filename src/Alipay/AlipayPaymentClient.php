<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:16
 */

namespace Payment\Alipay;

use Payment\PaymentClient;
use Payment\Alipay\Parameters\AlipayDirectParameter;
use Payment\Alipay\Parameters\AlipayWapOrderParameter;
use Payment\Alipay\Parameters\AlipayWapRefundParameter;
use Payment\Alipay\Parameters\AlipayWapTransParameter;
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
class AlipayPaymentClient extends PaymentClient
{

    public function unifiedOrder(PreOrderParameter $parameter)
    {
        $url = $this->config->get('alipay_url');

        $data = http_build_query($parameter->getRequestData());

        $header['content-type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8');

        $result = $this->post($data,$url,30,null,$header);

        return $result;
    }


    public function refund(RefundParameter $parameter)
    {
        return $this->handle($parameter);
    }



    public function handle(AbstractParameter $parameter)
    {
        //支付宝手机网站即时到账
        if($parameter instanceof AlipayWapOrderParameter){
            $parameter->sign();

            $params = http_build_query($parameter->getRequestData()) . '&sign_type=' . $parameter->getSignType();

            return AlipayConfiguration::ALIPAY_GATEWAY . $params;
        }
        //即时到账有密退款接口
        if ($parameter instanceof AlipayWapRefundParameter){
            $parameter->sign();

            $params = http_build_query($parameter->getRequestData()) . '&sign_type=' . $parameter->getSignType();

            return AlipayConfiguration::ALIPAY_GATEWAY . $params;
        }
        //批量付款到支付宝账户有密接口
        if($parameter instanceof AlipayWapTransParameter){
            $parameter->sign();

            $params = http_build_query($parameter->getRequestData()) . '&sign_type=' . $parameter->getSignType();

            return AlipayConfiguration::ALIPAY_GATEWAY . $params;
        }
        //支付宝即时到账
        if($parameter instanceof AlipayDirectParameter){
            $parameter->sign();

            $params = http_build_query($parameter->getRequestData()) . '&sign_type=' . $parameter->getSignType();

            return AlipayConfiguration::ALIPAY_GATEWAY . $params;
        }
        //预付款滴定
        if($parameter instanceof PreOrderParameter){
            $url = $this->config->get('open_alipay_url');

            $data = http_build_query($parameter->getRequestData());

            $header['content-type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8');

            $result = $this->post($data,$url,30,null,$header);

            return $result;
        }
        //蚂蚁金服新版手机网页支付
        if($parameter instanceof TradeParameter){
            $url = $this->config->get('open_alipay_url');

            $parameter->sign();

            $data = http_build_query($parameter->getRequestData());

            $header['content-type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8');

            $result = $this->post($data,$url,30,null,$header);

            return $result;
        }
        return null;
    }
}