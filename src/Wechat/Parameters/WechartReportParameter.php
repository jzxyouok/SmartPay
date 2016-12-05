<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 16:49
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;

/**
 * 微信交易保障接口
 * Class WechartReportParameter
 * @package Payment\Wechat\Parameters
 * @property string $appid 微信分配的公众账号ID（企业号corpid即为此appId）
 * @property string $mch_id 微信支付分配的商户号
 * @property string $device_info 终端设备号(门店号或收银设备ID)，注意：PC网页或公众号内支付请传"WEB"
 * @property string $nonce_str 随机字符串，不长于32位。
 * @property string $sign 签名
 * @property string $sign_type 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
 * @property string $interface_url 刷卡支付终端上报统一填：https://api.mch.weixin.qq.com/pay/batchreport/micropay/total
 * @property string $user_ip 发起接口调用时的机器IP
 */
class WechartReportParameter extends WechatParameter
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

        if(!array_key_exists('user_ip',$this->requestData)){
            $this->requestData['user_ip'] = $_SERVER['REMOTE_ADDR'];
        }

        if(!array_key_exists('device_info',$this->requestData)){
            $this->requestData['device_info'] = 'WEB';
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
        if(!array_key_exists('interface_url',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 interface_url');
        }
    }

}