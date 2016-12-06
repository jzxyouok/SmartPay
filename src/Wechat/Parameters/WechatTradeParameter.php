<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 16:29
 */

namespace Payment\Wechat\Parameters;

use Payment\Exceptions\PaymentException;
use Payment\Parameters\TradeParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 刷卡支付提交订单参数
 * Class WechatQrParameter
 * @package Payment\Wechat\Parameters
 * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_10&index=1
 * @property string $appid 微信分配的公众账号ID（企业号corpid即为此appId）
 * @property string $mch_id 微信支付分配的商户号
 * @property string $device_info 终端设备号(门店号或收银设备ID)，注意：PC网页或公众号内支付请传"WEB"
 * @property string $nonce_str 随机字符串，不长于32位。
 * @property string $sign 签名
 * @property string $sign_type 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
 * @property string $body 商品简单描述，该字段须严格按照规范传递
 * @property string $detail 商品详细列表，使用Json格式，传输签名前请务必使用CDATA标签将JSON文本串保护起来。
 * @property string $attach 附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
 * @property string $out_trade_no 商户系统内部的订单号,32个字符内、可包含字母
 * @property string $fee_type 符合ISO 4217标准的三位字母代码，默认人民币：CNY
 * @property int $total_fee 订单总金额，单位为分
 * @property string $spbill_create_ip APP和网页支付提交用户端ip，Native支付填调用微信支付API的机器IP。
 * @property string $goods_tag 商品标记，代金券或立减优惠功能的参数
 * @property string $auth_code  扫码支付授权码，设备读取用户微信中的条码或者二维码信息
 */
class WechatTradeParameter extends TradeParameter
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

        if(!array_key_exists('spbill_create_ip',$this->requestData)){
            $this->requestData['spbill_create_ip'] = $_SERVER['REMOTE_ADDR'];
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

        if(!array_key_exists('body',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 body');
        }
        if(!array_key_exists('out_trade_no', $this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 out_trade_no');
        }
        if(!array_key_exists('total_fee',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 total_fee');
        }

        if(!array_key_exists('spbill_create_ip',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 spbill_create_ip');
        }
        if(!array_key_exists('auth_code',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 auth_code');
        }
    }

}