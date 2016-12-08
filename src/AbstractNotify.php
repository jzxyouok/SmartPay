<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 17:18
 */

namespace Payment;

use Payment\Configuration\PayConfiguration;
use Payment\Exceptions\PaymentException;

/**
 * 第三方通知基类
 * Class AbstractNotify
 * @package Payment
 * @property PayConfiguration $config
 * @property array $requestData
 */
abstract class AbstractNotify
{
    protected $config;
    protected $requestData;

    public function __construct(PayConfiguration $config)
    {
        mb_internal_encoding("UTF-8");
        $this->config = $config;
        $this->requestData = $this->getRequestData();
    }

    /**
     * 处理第三方通知
     * @param NotifyInterface $notify
     * @return mixed
     * @throws PaymentException
     */
    final public function handle(NotifyInterface $notify)
    {
        //判断是否获取了数据
        if($this->requestData === false){
            throw new PaymentException('获取通知数据失败');
        }
        //校验数据是否合法
        $result = $this->verifySign();

        if($result === false){
            throw new PaymentException('签名校验失败');
        }
        //调用用户业务逻辑
        $processResult = $notify->process($this->requestData);

        if ($processResult) {
            $msg = 'OK';
        } else {
            $msg = '商户逻辑调用出错';
        }

        //生成响应给第三方的数据
        return $this->reply($processResult,$msg);
    }

    /**
     * 获取第三方请求的数据库
     * @return array|bool
     */
    abstract protected function getRequestData();

    /**
     * 校验签名是否正确
     * @param array $data
     * @return bool
     */
    abstract protected function verifySign();

    /**
     * 将处理结果响应给第三方
     * @param string $message
     * @param bool $isSuccess
     * @return mixed
     */
    abstract protected function reply($isSuccess, $message);

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
            if(isset($sslcert['sslkey_path'])) {
                //设置证书
                //使用证书：cert 与 key 分别属于两个.pem文件
                curl_setopt($ch, CURLOPT_SSLCERTTYPE, $sslcert['sslcert_type']);
                curl_setopt($ch, CURLOPT_SSLCERT, $sslcert['sslcert_path']);
                curl_setopt($ch, CURLOPT_SSLKEYTYPE, $sslcert['sslkey_type']);
                curl_setopt($ch, CURLOPT_SSLKEY, $sslcert['sslkey_path']);
            }else{
                curl_setopt($ch,CURLOPT_CAINFO,$sslcert['sslcert_path']);
            }
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
        if($data !== null){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

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