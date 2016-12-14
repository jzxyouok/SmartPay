<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 16:49
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 微信交易保障接口
 * Class WechartReportParameter
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_8
 *
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
class WechatReportParameter extends AbstractParameter
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

    /**
     * 微信支付分配的终端设备号，商户自定义
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * 微信支付分配的终端设备号，商户自定义
     *
     * @param string $device_info
     */
    public function setDeviceInfo($device_info)
    {
        $this->device_info = $device_info;
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
     */
    public function setSignType($sign_type)
    {
        $this->sign_type = $sign_type;
    }

    /**
     * 接口URL
     * @return string
     */
    public function getInterfaceUrl()
    {
        return $this->interface_url;
    }

    /**
     * 报对应的接口的完整URL，类似：
     * https://api.mch.weixin.qq.com/pay/unifiedorder
     * 对于刷卡支付，为更好的和商户共同分析一次业务行为的整体耗时情况，对于两种接入模式，请都在门店侧对一次刷卡支付进行一次单独的整体上报，上报URL指定为：
     * https://api.mch.weixin.qq.com/pay/micropay/total
     * 关于两种接入模式具体可参考本文档章节：刷卡支付商户接入模式
     * 其它接口调用仍然按照调用一次，上报一次来进行。
     *
     * @param string $interface_url
     */
    public function setInterfaceUrl($interface_url)
    {
        $this->interface_url = $interface_url;
    }

    /**
     * 接口URL
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->user_ip;
    }

    /**
     * @param string $user_ip
     */
    public function setUserIp($user_ip)
    {
        $this->user_ip = $user_ip;
    }



}