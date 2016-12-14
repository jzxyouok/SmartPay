<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:16
 */

namespace Payment\Alipay;

use Payment\Alipay\Results\AlipayTradeCloseResult;
use Payment\Alipay\Results\AlipayTradeQrCodeResult;
use Payment\Alipay\Results\AlipayTradeQueryResult;
use Payment\Alipay\Results\AlipayTradeRefundResult;
use Payment\Alipay\Results\AlipayTradeRefundQueryResult;
use Payment\Alipay\Results\AlipayTradeBillResult;
use Payment\Alipay\Results\AlipayTradeCancelResult;
use Payment\Alipay\Results\AlipayTradeOrderResult;
use Payment\Configuration\PayConfiguration;
use Payment\Parameters\AppParameter;
use Payment\Parameters\QrCodeParameter;
use Payment\PaymentClient;
use Payment\Alipay\Parameters\AlipayDirectParameter;
use Payment\Alipay\Parameters\AlipayWapOrderParameter;
use Payment\Alipay\Parameters\AlipayWapRefundParameter;
use Payment\Alipay\Parameters\AlipayWapTransParameter;
use Payment\Parameters\AbstractParameter;
use Payment\Parameters\BillParameter;
use Payment\Parameters\CloseOrderParameter;
use Payment\Parameters\PreOrderParameter;
use Payment\Parameters\QueryOrderParameter;
use Payment\Parameters\RefundParameter;
use Payment\Parameters\RefundQueryParameter;
use Payment\Parameters\ReverseParameter;
use Payment\Parameters\TradeParameter;

/**
 * 支付宝接口实现
 * Class AlipayPaymentProvider
 * @package Payment\Alipay
 */
class AlipayPaymentClient extends PaymentClient
{

    public function __construct(PayConfiguration $config)
    {
        mb_internal_encoding("UTF-8");
        parent::__construct($config);

    }

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

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $result = $this->post($data,$url,30);

            $json = json_decode($result,true);

            return $json === null ? null : new AlipayTradeOrderResult($json);

        }
        //统一收单线下交易查询
        if($parameter instanceof QueryOrderParameter){

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $result = $this->post($data,$url,30);

            $json = json_decode($result,true);


            return $json === null ? null : new AlipayTradeQueryResult($json);
        }
        //统一收单交易关闭接口
        if($parameter instanceof CloseOrderParameter){
            $url = $this->config->get('open_alipay_url');

            $parameter->sign();
            $data = $parameter->getRequestData();

            $result = $this->post($data,$url,30);

            $charset = mb_detect_encoding($result, "UTF-8,GBK");
            //如果编码不是UTF-8则转换
            if(strcasecmp($charset,'UTF-8')){
                $result = mb_convert_encoding($result,'UTF-8',$charset);
            }


            $json = json_decode($result,true);


            return $json === null ? null : new AlipayTradeCloseResult($json);
        }

        //统一收单交易退款接口
        if($parameter instanceof RefundParameter){

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $result = $this->post($data,$url,30,null,null);

            $charset = mb_detect_encoding($result, "UTF-8,GBK");
            //如果编码不是UTF-8则转换
            if(strcasecmp($charset,'UTF-8')){
                $result = mb_convert_encoding($result,'UTF-8',$charset);
            }


            $json = json_decode($result,true);


            return $json === null ? null : new AlipayTradeRefundResult($json);
        }

        //统一收单交易退款查询
        if($parameter instanceof RefundQueryParameter){

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $result = $this->post($data,$url,30,null,null);

            $json = json_decode($result,true);


            return $json === null ? null : new AlipayTradeRefundQueryResult($json);
        }

        //下载对账单
        if($parameter instanceof BillParameter){

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $header['Content-Type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8').';';


            $result = $this->post($data,$url,30,null,null);

            $json = json_decode($result,true);


            return $json === null ? null : new AlipayTradeBillResult($json);
        }
        //统一收单交易撤销接口
        if($parameter instanceof ReverseParameter){

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $header['Content-Type'] = 'application/x-www-form-urlencoded;charset=' . $this->config->get('charset','utf-8').';';


            $result = $this->post($data,$url,30,null,null);

            $json = json_decode($result,true);


            return $json === null ? null : new AlipayTradeCancelResult($json);
        }
        //统一收单线下交易预创建二维码结果
        if($parameter instanceof QrCodeParameter){

            $parameter->sign();
            $data = $parameter->getRequestData();

            $url = $this->config->get('open_alipay_url') . '?' . http_build_query($data);

            $result = $this->post($data,$url,30);

            $json = json_decode($result,true);

            return $json === null ? null : new AlipayTradeQrCodeResult($json);
        }
        //App支付请求参数说明
        if($parameter instanceof AppParameter){
            $parameter->sign();
            $data = $parameter->getRequestData();
            return $data['sign'];
        }
        return null;
    }
}