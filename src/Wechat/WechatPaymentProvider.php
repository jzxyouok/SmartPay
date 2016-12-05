<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 10:55
 */

namespace Payment\Wechat;

use Payment\Exceptions\PaymentException;
use Payment\AbstractParameter;
use Payment\AbstractPaymentProvider;
use Payment\Wechat\Parameters\WechatQrParameter;
use Payment\Wechat\Parameters\WechatUnifiedOrderParameter;

/**
 * 微信支付接口
 * Class WechatPaymentProvider
 * @package Payment\Wechat
 */
class WechatPaymentProvider extends AbstractPaymentProvider
{

    protected function handle($url, AbstractParameter $parameters)
    {
        $parameters->sign();

        $params = $parameters->getRequestData();

        $param = convert_array_to_xml($params);


        $responseText = $this->post($param, $url);

        $response = convert_xml_to_array($responseText);

        $result = new WechatResult($response);

        return $result;
    }

    /**
     * 刷卡下单接口
     * @param AbstractParameter $parameters
     * @return WechatResult
     */
    public function micropay(AbstractParameter $parameters)
    {
        $url = $this->config->get('micropay_url');

        $result = $this->handle($url,$parameters);

        return $result;
    }

    /**
     * 下单接口，支持扫码下单和普通下单
     * @param AbstractParameter $parameters
     * @return WechatResult
     * @throws PaymentException
     */
    public function unifiedOrder(AbstractParameter $parameters)
    {
        if($parameters instanceof WechatQrParameter){
            $url = $this->config->get('micropay_url');
        }elseif ($parameters instanceof WechatUnifiedOrderParameter){
            $url = $this->config->get('unifiedorder_url');
        }

        if(empty($url)){
            throw new PaymentException('不支持的支付类型');
        }
        $result = $this->handle($url,$parameters);

        return $result;
    }

    /**
     * 订单查询接口
     * @param AbstractParameter $parameters
     * @return WechatResult
     */
    public function queryOrder(AbstractParameter $parameters)
    {
        $url = $this->config->get('orderquery_url');

        $result = $this->handle($url,$parameters);

        return $result;
    }

    /**
     * 关闭订单
     * @param AbstractParameter $parameters
     * @return WechatResult
     */
    public function closeOrder(AbstractParameter $parameters)
    {
        $url = $this->config->get('closeorder_url');

        $result = $this->handle($url,$parameters);

        return $result;
    }

    /**
     * 订单退款
     * @param AbstractParameter $parameters
     * @return WechatResult
     */
    public function refund(AbstractParameter $parameters)
    {
        $url = $this->config->get('refund_url');

        $result = $this->handle($url,$parameters);

        return $result;
    }

    /**
     * 退款订单查询
     * @param AbstractParameter $parameters
     * @return WechatResult
     */
    public function refundQuery(AbstractParameter $parameters)
    {
        $url = $this->config->get('refundquery_url');

        $result = $this->handle($url,$parameters);

        return $result;
    }

    /**
     * 下载对账单
     * @param AbstractParameter $parameters
     * @return mixed|WechatResult
     */
    public function queryBill(AbstractParameter $parameters)
    {
        $parameters->sign();

        $params = $parameters->getRequestData();

        $param = convert_array_to_xml($params);


        $responseText = $this->post($param, $this->config->get('querybill_url'));

        if(substr($responseText, 0 , 5) == "<xml>"){
            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }else{
            return $responseText;
        }
    }

    /**
     * 交易故障上报
     * @param AbstractParameter $parameters
     * @return void
     */
    protected function report(AbstractParameter $parameters)
    {
        // TODO: Implement report() method.
    }

    /**
     * 生成短链接
     * @param AbstractParameter $parameters
     * @return WechatResult
     */
    public function createShortUrl(AbstractParameter $parameters)
    {
        $url = $this->config->get('shorturl_url');

        $result = $this->handle($url,$parameters);

        return $result;
    }
}