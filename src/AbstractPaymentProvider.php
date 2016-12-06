<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 11:02
 */

namespace Payment;

use Payment\Configuration\PayConfiguration;
use Payment\Exceptions\PaymentException;
use Payment\Parameters\AppParameter;
use Payment\Parameters\QrCodeParameter;
use Payment\Parameters\OrderParameter;
use Payment\Parameters\ReportParameter;
use Payment\Parameters\ReverseParameter;
use Payment\Parameters\TradeParameter;
use Payment\Parameters\PreOrderParameter;
use Payment\Parameters\QueryOrderParameter;
use Payment\Parameters\CloseOrderParameter;
use Payment\Parameters\RefundParameter;
use Payment\Parameters\RefundQueryParameter;
use Payment\Parameters\BillParameter;


/**
 * 支付基类
 * Class PaymentBase
 * @package Payment
 */
abstract class AbstractPaymentProvider
{
    /**
     * @var PayConfiguration 支付配置对象
     */
    protected $config;

    public function __construct(PayConfiguration $config)
    {
        mb_internal_encoding("UTF-8");
        $this->config = $config;
    }

    /**
     * 创建APP支付需要的签名信息
     * @param AppParameter $parameter
     * @return mixed
     */
    abstract public function createAppSign(AppParameter $parameter);

    /**
     * 生成扫码支付的二维码内容
     * @param QrCodeParameter $parameter
     * @return mixed
     */
    abstract public function createQrCode(QrCodeParameter $parameter);

    /**
     * 创建支付订单
     * @param OrderParameter $parameter
     * @return mixed
     */
    abstract public function createOrder(OrderParameter $parameter);
    /**
     * 商户扫码支付
     * @param TradeParameter $parameters
     * @return mixed
     */
    abstract public function micropay(TradeParameter $parameters);
    /**
     * 预生成订单，适用于用户扫码
     * @param PreOrderParameter $parameters
     * @return mixed
     */
    abstract public function unifiedOrder(PreOrderParameter $parameters);

    /**
     * 订单查询
     * @param QueryOrderParameter $parameters
     * @return mixed
     */
    abstract public function queryOrder(QueryOrderParameter $parameters);

    /**
     * 关闭订单
     * @param CloseOrderParameter $parameters
     * @return mixed
     */
    abstract public function closeOrder (CloseOrderParameter $parameters);

    /**
     * 申请退款
     * @param RefundParameter $parameters
     * @return mixed
     */
    abstract public function refund(RefundParameter $parameters);

    /**
     * 查询退款
     * @param RefundQueryParameter $parameters
     * @return mixed
     */
    abstract public function refundQuery(RefundQueryParameter $parameters);

    /**
     * 账单查询
     * @param BillParameter $parameters
     * @return mixed
     */
    abstract public function queryBill(BillParameter $parameters);

    /**
     * 交易保障接口,程序根据配置自动上报
     * @param ReportParameter $parameters
     * @return mixed
     */
    abstract protected function report(ReportParameter $parameters);

    /**
     * 撤销支付订单
     * @param ReverseParameter $parameter
     * @return mixed
     */
    abstract public function reverse(ReverseParameter $parameter);
    /**
     * 发起 POST 请求
     * @param array|string $data 请求的数据
     * @param string $url 请求路径
     * @param int $second 超时时间
     * @param null|array $sslcert 请求的证书数组
     * @return mixed
     * @throws PaymentException
     */
    protected function post($data, $url, $second = 30,$sslcert = null)
    {
        if(empty($url)){
            throw new \InvalidArgumentException('缺少参数 $url');
        }
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验

        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if(empty($sslcert) === false){
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,$sslcert['sslcert_type']);
            curl_setopt($ch,CURLOPT_SSLCERT, $sslcert['sslcert_path']);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,$sslcert['sslkey_type']);
            curl_setopt($ch,CURLOPT_SSLKEY, $sslcert['sslkey_path']);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            $info = curl_getinfo($ch);

            curl_close($ch);
            throw new PaymentException("curl出错，错误码:$error, curl_getinfo: " . print_r($info,true) );
        }
    }
}