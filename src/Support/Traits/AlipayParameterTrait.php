<?php

namespace Payment\Support\Traits;

trait AlipayParameterTrait
{

    public $appid;

    protected function createSign()
    {
        $sign = '';
        switch ($this->sign_type) {
            case 'MD5' :
                $this->signStr .= $this->key;// 此处不需要通过 & 符号链接
                $sign = md5($this->signStr);
                break;
            case 'RSA' :
                $rsa_private_key = @file_get_contents($this->rsa_private_path);
                $rsa = new RsaEncrypt($rsa_private_key);
                $sign = $rsa->encrypt($this->signStr);
                break;
            default :
                $sign = '';
        }
        return $sign;
    }
}