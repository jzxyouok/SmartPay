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
use Payment\Parameters\AbstractParameter;


/**
 * 支付基类
 * Class PaymentBase
 * @package Payment
 */
abstract class PaymentClient
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


    abstract public function handle(AbstractParameter $parameter);

    /**
     * 发起 POST 请求
     * @param array|string $data 请求的数据
     * @param string $url 请求路径
     * @param int $second 超时时间
     * @param null|array $sslcert 请求的证书数组
     * @param array|null $headers 请求头
     * @return mixed
     * @throws PaymentException
     */
    protected function post($data, $url, $second = 30,$sslcert = null, $headers = null)
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

        if(is_array($headers) && empty($headers) === false){
            $header = array();
            foreach ($headers as $key=>$value){
                $header[] = $key.':'.$value;
            }
            if(count($header) > 0){
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            }
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