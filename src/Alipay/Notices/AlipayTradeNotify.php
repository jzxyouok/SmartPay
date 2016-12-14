<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 16:02
 */

namespace Payment\Alipay\Notices;


use Payment\AbstractNotify;
use Payment\Alipay\AlipayConfiguration;

abstract class AlipayTradeNotify extends AbstractNotify
{
    protected $data = [];

    protected $config;

    public function __construct(AlipayConfiguration $config)
    {
        parent::__construct($config);
        foreach ($_POST as $key=>$value){
            $this->data[$key] = urldecode($value);
        }

        $this->config = $config;
    }

    protected function getRequestData()
    {
        return $this->data;
    }

    /**
     * 签名算法类型，目前支持RSA
     * @return string|null
     */
    public function getSignType()
    {
        return array_value('sign_type',$this->data);
    }

    /**
     * 签名
     * @return string|null
     */
    public function getSign()
    {
        return array_value('sign',$this->data);
    }

    /**
     * 校验签名
     * @return bool|string
     * @throws \Payment\Exceptions\PaymentException
     */
    protected function verifySign()
    {
        $params = $this->data;

        unset($params['sign']);
        unset($params['sign_type']);

        ksort($params);

        $string = http_build_query_params($params);

        if($this->getSignType() == 'RSA') {
            $rsa_private_key = @file_get_contents($this->config->getRsaPrivatePath());

            $string = rsa_encrypt($rsa_private_key, $string);
        }elseif ($this->getSignType() == 'MD5'){
            $string = md5($string. $this->config->getKey());
        }

        if($string === false){
            throw new \Payment\Exceptions\PaymentException('RSA 加密时出错');
        }

        return $string;
    }


    public function __get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}