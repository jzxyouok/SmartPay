<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:35
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\CloseOrderParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 关闭订单接口
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_3
 *
 * @package Payment\Wechat\Parameters
 *
 */
class WechatCloseOrderParameter extends CloseOrderParameter
{
    use WechatParameterTrait;

    /**
     * 商户系统内部的订单号
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户系统内部的订单号
     * @param string $out_trade_no
     * @return WechatCloseOrderParameter
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
        return $this;
    }

    /**
     * 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
     * @return string
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
     * @param string $sign_type
     * @return $this
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
        return $this;
    }


    protected function buildData()
    {
        if(!array_key_exists('appid',$this->requestData)){
            $this->requestData['appid'] = $this->appid;
        }
        if(!array_key_exists('mch_id',$this->requestData)){
            $this->requestData['mch_id'] = $this->mch_id;
        }
        if(!array_key_exists('nonce_str',$this->requestData)){
            $this->requestData['nonce_str'] = create_random(32);
        }
        if(!array_key_exists('sign_type',$this->requestData)){
            $this->requestData['sign_type'] = 'MD5';
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