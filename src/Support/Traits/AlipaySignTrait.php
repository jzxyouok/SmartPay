<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 15:06
 */

namespace Payment\Support\Traits;

trait AlipaySignTrait
{
    /**
     * 生成签名
     * @return bool|string
     * @throws PaymentException
     */
    protected function createSign()
    {
        ksort($this->requestData);
        reset($this->requestData);

        $signString = http_build_query_params($this->requestData);

        $sign = '';

        if(strcasecmp($this->getSignType(),'MD5') === 0){
            $signString = $signString . $this->getKey();
            $sign = md5($signString);
        }elseif (strcasecmp($this->getSignType(),'RSA') === 0){
            if(!file_exists($this->getRsaPrivatePath())){
                throw new PaymentException('RSA 加密的私钥文件不存在');
            }
            $rsa_private_key = @file_get_contents($this->getRsaPrivatePath());
            $sign = rsa_encrypt($rsa_private_key,$signString);
        }
        return $sign;
    }
}