<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:35
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;

/**
 * Class WechatCloseOrderParameter
 * @package Payment\Wechat\Parameters
 * @property string $appid 微信分配的公众账号ID（企业号corpid即为此appId）
 * @property string $mch_id 微信支付分配的商户号
 * @property string $out_trade_no 商户系统内部的订单号,32个字符内、可包含字母
 * @property string $nonce_str 随机字符串，不长于32位。
 * @property string $sign 签名
 * @property string $sign_type 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
 */
class WechatCloseOrderParameter extends WechatParameter
{
    protected function buildData()
    {
        if(!array_key_exists('appid',$this->requestData)){
            $this->requestData['appid'] = $this->config->get('app_id');
        }
        if(!array_key_exists('mch_id',$this->requestData)){
            $this->requestData['mch_id'] = $this->config->get('mch_id');
        }
        if(!array_key_exists('nonce_str',$this->requestData)){
            $this->requestData['nonce_str'] = create_random(32);
        }
        if(!array_key_exists(' sign_type ',$this->requestData)){
            $this->requestData[' sign_type '] = 'MD5';
        }
    }

    protected function checkDataParams()
    {
        if(!array_key_exists('appid',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 appid');
        }
        if(!array_key_exists('mch_id',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 mch_id');
        }
        if(!array_key_exists('out_trade_no',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 out_trade_no');
        }
    }

}