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
 * Class WechatQrCodeParameter
 * @package Payment\Wechat\Parameters
 * @property string $appid 微信分配的公众账号ID（企业号corpid即为此appId）
 * @property string $mch_id 微信支付分配的商户号
 * @property string $nonce_str 随机字符串，不长于32位。
 * @property string $sign 签名
 * @property string $time_stamp 系统当前时间
 * @property string $product_id 商户定义的商品id 或者订单号
 *
 */
class WechatQrCodeParameter extends QrCodeParameter
{
    use WechatParameterTrait;


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