<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 11:28
 */

namespace Payment\Wechat\Parameters;

use Payment\Exceptions\PaymentException;
use Payment\Parameters\AppParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 微信APP发起支付前的签名参数
 * Class WechatIOSSignParameter
 * @package Payment\Wechat\Parameters
 * @property string $appid 微信开放平台审核通过的应用APPID
 * @property string $partnerid 微信支付分配的商户号
 * @property string $prepayid 微信返回的支付交易会话ID
 * @property string $package 暂填写固定值Sign=WXPay
 * @property string $timestamp 时间戳
 */
class WechatIOSSignParameter extends AppParameter
{
    use WechatParameterTrait;

    protected function buildData()
    {
        if(!array_key_exists('appid',$this->requestData)){
            $this->requestData['appid'] = $this->config->get('app_id');
        }
        if(!array_key_exists('partnerid',$this->requestData)){
            $this->requestData['partnerid'] = $this->config->get('mch_id');
        }

        if(!array_key_exists('nonce_str',$this->requestData)){
            $this->requestData['nonce_str'] = create_random(32);
        }
    }

    protected function checkDataParams()
    {
        if(!array_key_exists('appid',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 appid');
        }
        if(!array_key_exists('partnerid',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 partnerid');
        }
        if(!array_key_exists('prepayid',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 prepayid');
        }
        if(!array_key_exists('package',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 package');
        }
    }

    public function __set($name, $value)
    {
        if($name == 'mch_id'){
            $this->requestData['partnerid'] = $value;
        }
        parent::__set($name,$value);
    }
    public function __get($name)
    {
        if($name == 'mch_id'){
            return $this->requestData['partnerid'];
        }
        return parent::__get($name);
    }
}