<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 10:55
 */

namespace Payment\Wechat;

use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\PaymentClient;
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
use Payment\Wechat\Parameters\WechatShortUrlParameter;

/**
 * 微信支付接口
 * Class WechatPaymentClient
 * @package Payment\Wechat
 */
class WechatPaymentClient extends PaymentClient
{
    /**
     * 获取生成微信用户扫码支付的二维码内容，该接口实现的是微信用户扫码模式一
     * @param QrCodeParameter $parameter
     * @return string
     */
    public function createQrCode(QrCodeParameter $parameter)
    {
        return $this->handle($parameter);
    }

    /**
     *
     * 执行对应参数的处理方法
     * @param AbstractParameter $parameter
     * @return mixed|null|WechatResult|string
     * @throws PaymentException
     */
    public function handle(AbstractParameter $parameter)
    {
        //获取生成微信用户扫码支付的二维码内容，该接口实现的是微信用户扫码模式一
        if($parameter instanceof QrCodeParameter){
            $parameter->sign();
            $url = "weixin://wxpay/bizpayurl?sign={$parameter->sign}&appid={$parameter->appid}&mch_id={$parameter->mch_id}&product_id={$parameter->product_id}&time_stamp={$parameter->time_stamp}&nonce_str={$parameter->nonce_str}";

            return $url;
        }
        //刷卡下单接口
        if($parameter instanceof TradeParameter){
            $url = $this->config->get('micropay_url');
            $parameter->sign();

            $params = $parameter->getRequestData();

            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url);

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        //创建支付订单
        if($parameter instanceof OrderParameter){
            $url = $this->config->get('unifiedorder_url');
            $parameter->sign();

            $params = $parameter->getRequestData();

            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url);

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        //订单查询接口
        if($parameter instanceof QueryOrderParameter){
            $url = $this->config->get('orderquery_url');
            $parameter->sign();

            $params = $parameter->getRequestData();

            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url);

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        //关闭订单
        if($parameter instanceof CloseOrderParameter){
            $url = $this->config->get('closeorder_url');
            $parameter->sign();

            $params = $parameter->getRequestData();

            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url);

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        //订单退款
        if($parameter instanceof RefundParameter){
            $url = $this->config->get('refund_url');


            if(empty($this->config->get('sslcert'))){
                throw new PaymentException('退款接口需要双向SSL证书加密，配置中未找到证书');
            }

            $parameter->sign();

            $params = $parameter->getRequestData();


            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url,$this->config->get('sslcert'));

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }

        if($parameter instanceof RefundQueryParameter){
            $url = $this->config->get('refundquery_url');
            $parameter->sign();

            $params = $parameter->getRequestData();

            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url);

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        //下载对账单
        if($parameter instanceof BillParameter){
            $parameter->sign();

            $params = $parameter->getRequestData();

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
        //生成短链接
        if($parameter instanceof WechatShortUrlParameter){
            $url = $this->config->get('shorturl_url');
            $parameter->sign();

            $params = $parameter->getRequestData();

            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url);

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        //获取APP调起微信支付的签名
        if($parameter instanceof AppParameter){
            $parameter->sign();
            return $parameter->sign;
        }
        if($parameter instanceof ReverseParameter){
            $url = $this->config->get('reverse_url');


            if(empty($this->config->get('sslcert'))){
                throw new PaymentException('撤销订单接口需要双向SSL证书加密，配置中未找到证书');
            }

            $parameter->sign();

            $params = $parameter->getRequestData();


            $param = convert_array_to_xml($params);

            $responseText = $this->post($param, $url,$this->config->get('sslcert'));

            $response = convert_xml_to_array($responseText);

            $result = new WechatResult($response);

            return $result;
        }
        return null;
    }

    /**
     * 刷卡下单接口
     * @param TradeParameter $parameters
     * @return WechatResult
     */
    public function micropay(TradeParameter $parameters)
    {
        $result = $this->handle($parameters);

        return $result;
    }

    /**
     * 创建支付订单
     * @param OrderParameter $parameter
     * @return WechatResult
     * @throws PaymentException
     */
    public function createOrder(OrderParameter $parameter)
    {
        $result = $this->handle($parameter);

        return $result;
    }

    /**
     * 生成预支付订单接口，支持用户扫码下单和普通下单
     * @param PreOrderParameter $parameter
     * @return WechatResult
     * @throws PaymentException
     */
    public function unifiedOrder(PreOrderParameter $parameter)
    {

        $result = $this->handle($parameter);

        return $result;
    }

    /**
     * 订单查询接口
     * @param QueryOrderParameter $parameter
     * @return WechatResult
     */
    public function queryOrder(QueryOrderParameter $parameter)
    {
        $result = $this->handle($parameter);

        return $result;
    }

    /**
     * 关闭订单
     * @param CloseOrderParameter $parameters
     * @return WechatResult
     */
    public function closeOrder(CloseOrderParameter $parameters)
    {
        $result = $this->handle($parameters);

        return $result;
    }

    /**
     * 订单退款
     * @param RefundParameter $parameter
     * @return WechatResult
     * @throws PaymentException
     */
    public function refund(RefundParameter $parameter)
    {
        $result = $this->handle($parameter);

        return $result;
    }

    /**
     * 退款订单查询
     * @param RefundQueryParameter $parameters
     * @return WechatResult
     */
    public function refundQuery(RefundQueryParameter $parameters)
    {
        $result = $this->handle($parameters);

        return $result;
    }

    /**
     * 下载对账单
     * @param BillParameter $parameter
     * @return mixed|WechatResult
     */
    public function queryBill(BillParameter $parameter)
    {
        return $this->handle($parameter);
    }

    /**
     * 交易故障上报
     * @param ReportParameter $parameters
     * @return void
     */
    protected function report(ReportParameter $parameters)
    {
        // TODO: Implement report() method.
    }

    /**
     * 生成短链接
     * @param WechatShortUrlParameter $parameters
     * @return WechatResult
     */
    public function createShortUrl(WechatShortUrlParameter $parameters)
    {
        $result = $this->handle($parameters);

        return $result;
    }

    /**
     * 获取APP调起微信支付的签名
     * @param AppParameter $parameter
     * @return null|string
     */
    public function createAppSign(AppParameter $parameter)
    {
        return $this->handle($parameter);
    }

    /**
     * 撤销订单
     * @link  https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_11&index=3
     * @param ReverseParameter $parameter
     * @return WechatResult
     * @throws PaymentException
     */
    public function reverse(ReverseParameter $parameter)
    {
        $result = $this->handle($parameter);

        return $result;
    }
}