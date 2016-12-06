<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:27
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\QueryOrderParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 订单查询参数
 * Class WechatQueryOrderParameter
 * @package Payment\Wechat\Parameters
 * @property string $appid 微信分配的公众账号ID（企业号corpid即为此appId）
 * @property string $mch_id 微信支付分配的商户号
 * @property string $transaction_id 微信的订单号，优先使用
 * @property string $ out_trade_no 商户系统内部的订单号，当没提供transaction_id时需要传这个。
 * @property string $nonce_str 随机字符串，不长于32位。
 * @property string $sign 签名
 * @property string $sign_type 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
 */
class WechatQueryOrderParameter extends QueryOrderParameter
{
    use WechatParameterTrait;

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

        if(!array_key_exists('transaction_id ',$this->requestData) && !array_key_exists('out_trade_no ',$this->requestData)){
            throw new PaymentException('订单查询接口中，out_trade_no、transaction_id至少填一个');
        }

    }

}