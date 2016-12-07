<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 16:42
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 微信生成短链接服务
 *
 * 该接口主要用于扫码原生支付模式一中的二维码链接转成短链接(weixin://wxpay/s/XXXXXX)，减小二维码数据量，提升扫描速度和精确度。
 *
 * @package Payment\Wechat\Parameters
 *
 */
class WechatShortUrlParameter extends AbstractParameter
{
    use WechatParameterTrait;

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
     * @return  WechatShortUrlParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
        return $this;

    }

    /**
     * 需要转换的URL，签名用原串，传输需URLencode
     * @return string
     */
    public function getLongUrl()
    {
        return $this->long_url;
    }

    /**
     * 需要转换的URL，签名用原串，传输需URLencode
     * @param string $long_url
     * @return WechatShortUrlParameter
     */
    public function setLongUrl($long_url)
    {
        $this->long_url = $long_url;
        return $this;
    }



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
        if(!array_key_exists('long_url',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 long_url');
        }
    }

}