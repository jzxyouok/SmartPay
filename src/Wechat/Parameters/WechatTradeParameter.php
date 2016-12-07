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
 *
 * 收银员使用扫码设备读取微信用户刷卡授权码以后，二维码或条码信息传送至商户收银台，由商户收银台或者商户后台调用该接口发起支付。
 * 提醒1：提交支付请求后微信会同步返回支付结果。当返回结果为“系统错误”时，商户系统等待5秒后调用【查询订单API】，查询支付实际交易结果；当返回结果为“USERPAYING”时，商户系统可设置间隔时间(建议10秒)重新查询支付结果，直到支付成功或超时(建议30秒)；
 * 提醒2：在调用查询接口返回后，如果交易状况不明晰，请调用【撤销订单API】，此时如果交易失败则关闭订单，该单不能再支付成功；如果交易成功，则将扣款退回到用户账户。当撤销无返回或错误时，请再次调用。注意：请勿扣款后立即调用【撤销订单API】,建议至少15秒后再调用。撤销订单API需要双向证书。
 *
 * @package Payment\Wechat\Parameters
 * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_10&index=1
 */
class WechatTradeParameter extends TradeParameter
{
    use WechatParameterTrait;

    /**
     * 终端设备号(商户自定义，如门店编号)
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * 终端设备号(商户自定义，如门店编号)
     * @param string $device_info
     * @return WechatTradeParameter
     */
    public function setDeviceInfo($device_info = null)
    {
        if($device_info !== null){
            $this->device_info = $device_info;
        }
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
     * @return WechatTradeParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;

        return $this;
    }

    /**
     * 商品简单描述，该字段须严格按照规范传递，具体请见参数规定
     * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=4_2
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * 商品简单描述，该字段须严格按照规范传递，具体请见参数规定
     * @link  https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=4_2
     * @param string $body
     * @return WechatTradeParameter
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * 商品详细列表，使用Json格式，传输签名前请务必使用CDATA标签将JSON文本串保护起来。
     * @see goods_detail []：
     *       └ goods_id String 必填 32 商品的编号
     *       └ wxpay_goods_id String 可选 32 微信支付定义的统一商品编号
     *       └ goods_name String 必填 256 商品名称
     *       └ quantity Int 必填 商品数量
     *       └ price Int 必填 商品单价，单位为分
     *       └ goods_category String 可选 32 商品类目ID
     *       └ body String 可选 1000 商品描述信息
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * 商品详细列表，使用Json格式，传输签名前请务必使用CDATA标签将JSON文本串保护起来。
     * @see goods_detail []：
     *       └ goods_id String 必填 32 商品的编号
     *       └ wxpay_goods_id String 可选 32 微信支付定义的统一商品编号
     *       └ goods_name String 必填 256 商品名称
     *       └ quantity Int 必填 商品数量
     *       └ price Int 必填 商品单价，单位为分
     *       └ goods_category String 可选 32 商品类目ID
     *       └ body String 可选 1000 商品描述信息
     *
     * @param string $detail
     * @return WechatTradeParameter
     */
    public function setDetail($detail = null)
    {
        if($detail !== null){
            $this->detail = $detail;
        }
       return $this;
    }

    /**
     * 附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
     *
     * @return string
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * 附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
     *
     * @param string $attach
     * @return WechatTradeParameter
     */
    public function setAttach($attach)
    {
        $this->attach = $attach;
        return $this;
    }

    /**
     * 商户系统内部的订单号,32个字符内、可包含字母,其他说明见商户订单号
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户系统内部的订单号,32个字符内、可包含字母,其他说明见商户订单号
     *
     * @param string $out_trade_no
     * @return WechatTradeParameter
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
        return $this;
    }

    /**
     * 符合ISO4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=4_2
     * @return string
     */
    public function getFeeType()
    {
        return $this->fee_type;
    }

    /**
     * 符合ISO4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=4_2
     * @param string $fee_type
     * @return WechatTradeParameter
     */
    public function setFeeType($fee_type = 'CNY')
    {
        $this->fee_type = $fee_type;
        return $this;
    }

    /**
     * 订单总金额，单位为分，只能为整数，详见支付金额
     * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=4_2
     * @return int
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * 订单总金额，单位为分，只能为整数，详见支付金额
     * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=4_2
     * @param int $total_fee
     * @return WechatTradeParameter
     */
    public function setTotalFee($total_fee)
    {
        $this->total_fee = $total_fee;
        return $this;
    }

    /**
     * 调用微信支付API的机器IP
     * @return string
     */
    public function getSpbillCreateIp()
    {
        return $this->spbill_create_ip;
    }

    /**
     * 调用微信支付API的机器IP
     * @param string $spbill_create_ip
     * @return WechatTradeParameter
     */
    public function setSpbillCreateIp($spbill_create_ip)
    {
        if($spbill_create_ip == null){
            $this->spbill_create_ip = $_SERVER['REMOTE_ADDR'];
        }else {
            $this->spbill_create_ip = $spbill_create_ip;
        }

        return $this;
    }

    /**
     * 商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
     * @return string
     */
    public function getGoodsTag()
    {
        return $this->goods_tag;
    }

    /**
     * 商品标记，代金券或立减优惠功能的参数，说明详见代金券或立减优惠
     * @param string $goods_tag
     * @return WechatTradeParameter
     */
    public function setGoodsTag($goods_tag = null)
    {
        if($goods_tag  !== null){
            $this->goods_tag = $goods_tag;
        }
       return $this;
    }

    /**
     * 扫码支付授权码，设备读取用户微信中的条码或者二维码信息
     *
     * @return string
     */
    public function getAuthCode()
    {
        return $this->auth_code;
    }

    /**
     * 扫码支付授权码，设备读取用户微信中的条码或者二维码信息
     *
     * @param string $auth_code
     * @return WechatTradeParameter
     */
    public function setAuthCode($auth_code)
    {
        $this->auth_code = $auth_code;
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