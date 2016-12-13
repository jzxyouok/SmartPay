<?php

namespace Payment\Support\Traits;

use Payment\Alipay\Parameters\AlipayParameter;

/**
 * 支付宝支付的公共代码
 * Class AlipayParameterTrait
 * @package Payment\Support\Traits
 */
trait AlipayParameterTrait
{
    protected $_data = array();
    /**
     * @var AlipayParameter 公共参数
     */
    protected $parameter ;

    public function __construct(AlipayParameter $parameter)
    {
        $parameter->setMethod($this->method);
        $this->parameter = $parameter;
    }


    protected function createSign()
    {
        ksort($this->requestData);

        $string = http_build_query_params($this->getRequestData());

        //print_r($string);exit;

        if($this->parameter->getSignType() == 'RSA') {
            $rsa_private_key = @file_get_contents($this->parameter->getRsaPrivatePath());

            $string = rsa_encrypt($rsa_private_key, $string);
        }elseif ($this->parameter->getSignType() == 'MD5'){
            $string = md5($string. $this->parameter->getKey());
        }

        if($string === false){
            throw new \Payment\Exceptions\PaymentException('RSA 加密时出错');
        }

       return $string;
    }
}