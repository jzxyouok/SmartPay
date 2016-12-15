<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 15:59
 */

namespace Payment\Wechat\Results;

/**
 * 微信支付统一下单返回结果
 *
 * @package Payment\Wechat\Results
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_1
 *
 */
class WechatUnifiedOrderResult extends WechatResult
{
    /**
     * 自定义参数，可以为请求支付的终端设备号等
     * @return string
     */
    public function getDeviceInfo()
    {
        return array_value('device_info',$this->response);
    }

    /**
     * 交易类型，取值为：JSAPI，NATIVE，APP等
     * @return string
     */
    public function getTradeType()
    {
        return array_value('trade_type',$this->response);
    }

    /**
     * 微信生成的预支付回话标识，用于后续接口调用中使用，该值有效期为2小时
     * @return string
     */
    public function getPrepayId()
    {
        return array_value('prepay_id',$this->response);
    }

    /**
     * trade_type为NATIVE时有返回，用于生成二维码，展示给用户进行扫码支付
     * @return string
     */
    public function getCodeUrl()
    {
        return array_value('code_url',$this->response);
    }

}