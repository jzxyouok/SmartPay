<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 8:56
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\QrCodeParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 生成用户扫码的二维码参数
 *
 * 微信扫码支付模式一的二维码生成
 *
 * @package Payment\Wechat\Parameters
 *
 */
class WechatQrCodeParameter extends QrCodeParameter
{
    use WechatParameterTrait;

    /**
     * 系统当前时间，定义规则详见时间戳
     * @return string
     */
    public function getTimeStamp()
    {
        return $this->time_stamp;
    }

    /**
     * 系统当前时间，定义规则详见时间戳
     * @param string $time_stamp
     */
    public function setTimeStamp($time_stamp = null)
    {
        if($time_stamp == null){
            $time_stamp = time();
        }
        $this->time_stamp = $time_stamp;
    }

    /**
     * 商户定义的商品id 或者订单号
     * @return string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * 商户定义的商品id 或者订单号
     * @param string $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
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
        if(!array_key_exists('time_stamp',$this->requestData)){
            $this->requestData['time_stamp'] = time();
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
        if(!array_key_exists('product_id',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 product_id');
        }
    }

}