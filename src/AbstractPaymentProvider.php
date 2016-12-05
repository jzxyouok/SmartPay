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
     * 开始下单
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract public function unifiedOrder(AbstractParameter $parameters);

    /**
     * 订单查询
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract public function queryOrder(AbstractParameter $parameters);

    /**
     * 关闭订单
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract public function closeOrder (AbstractParameter $parameters);

    /**
     * 申请退款
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract public function refund(AbstractParameter $parameters);

    /**
     * 查询退款
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract public function refundQuery(AbstractParameter $parameters);

    /**
     * 账单查询
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract public function queryBill(AbstractParameter $parameters);

    /**
     * 交易保障接口,程序根据配置自动上报
     * @param AbstractParameter $parameters
     * @return mixed
     */
    abstract protected function report(AbstractParameter $parameters);

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
            curl_close($ch);
            throw new PaymentException("curl出错，错误码:$error");
        }
    }
}