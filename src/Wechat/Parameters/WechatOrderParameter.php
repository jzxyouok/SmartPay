<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 13:51
 */

namespace Payment\Wechat\Parameters;


use Payment\Parameters\OrderParameter;
use Payment\Support\Traits\WechatParameterTrait;
use Payment\Exceptions\PaymentException;


/**
 * 微信统一下单参数
 * Class OrderParameter
 * @package Payment\Wechat
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_1
 */
class WechatOrderParameter extends OrderParameter
{
    use WechatParameterTrait;

    /**
     * 自定义参数，可以为终端设备号(门店号或收银设备ID)，PC网页或公众号内支付可以传"WEB"
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * 自定义参数，可以为终端设备号(门店号或收银设备ID)，PC网页或公众号内支付可以传"WEB"
     * @param string $device_info
     * @return WechatOrderParameter
     */
    public function setDeviceInfo($device_info = null)
    {
        if($device_info !== null){
            $this->device_info = $device_info;
        }
        return $this;
    }

    /**
     * 签名类型，默认为MD5，支持HMAC-SHA256和MD5。
     * @return string
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * 签名类型，默认为MD5，支持HMAC-SHA256和MD5。
     * @param string $sign_type
     * @return WechatOrderParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
        return $this;
    }

    /**
     * 商品简单描述，该字段请按照规范传递，具体请见参数规定
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * 商品简单描述，该字段请按照规范传递，具体请见参数规定
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param string $body
     * @return WechatOrderParameter
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * 商品详细列表，使用Json格式，传输签名前请务必使用CDATA标签将JSON文本串保护起来。
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
     * @param string $detail
     * @return WechatOrderParameter
     */
    public function setDetail($detail = null)
    {
        if($detail !== null){
            $this->detail = $detail;
        }
        return $this;
    }

    /**
     *  附加数据，在查询API和支付通知中原样返回，可作为自定义参数使用。
     * @return string
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     *  附加数据，在查询API和支付通知中原样返回，可作为自定义参数使用。
     * @param string|null $attach
     * @return WechatOrderParameter
     */
    public function setAttach($attach = null)
    {
        if($attach != null){
            $this->attach = $attach;
        }
        return $this;
    }

    /**
     * 商户系统内部订单号，要求32个字符内、且在同一个商户号下唯一。 详见商户订单号
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户系统内部订单号，要求32个字符内、且在同一个商户号下唯一。 详见商户订单号
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param string $out_trade_no
     * @return WechatOrderParameter
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
        return $this;
    }

    /**
     * 符合ISO 4217标准的三位字母代码，默认人民币：CNY，详细列表请参见货币类型
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return string
     */
    public function getFeeType()
    {
        return $this->fee_type;
    }

    /**
     * 符合ISO 4217标准的三位字母代码，默认人民币：CNY，详细列表请参见货币类型
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param string $fee_type
     * @return WechatOrderParameter
     */
    public function setFeeType($fee_type = 'CNY')
    {
        $this->fee_type = $fee_type;
        return $this;
    }

    /**
     * 订单总金额，单位为分，详见支付金额
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return int
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * 订单总金额，单位为分，详见支付金额
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param int $total_fee
     * @return WechatOrderParameter
     */
    public function setTotalFee($total_fee)
    {
        $this->total_fee = $total_fee;
        return $this;
    }

    /**
     * APP和网页支付提交用户端ip，Native支付填调用微信支付API的机器IP
     * @return string
     */
    public function getSpbillCreateIp()
    {
        return $this->spbill_create_ip;
    }

    /**
     * APP和网页支付提交用户端ip，Native支付填调用微信支付API的机器IP
     * @param string $spbill_create_ip
     * @return WechatOrderParameter
     */
    public function setSpbillCreateIp($spbill_create_ip = null)
    {
        if($spbill_create_ip == null){
            $this->spbill_create_ip = $_SERVER['REMOTE_ADDR'];
        }else {
            $this->spbill_create_ip = $spbill_create_ip;
        }
        return $this;
    }

    /**
     * 订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。
     * @return string
     */
    public function getTimeStart()
    {
        return $this->time_start;
    }

    /**
     * 订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。
     * @param string $time_start
     * @return WechatOrderParameter
     */
    public function setTimeStart($time_start = null)
    {
        if($time_start === null){
            $time_start = time();
        }
        $this->time_start = $time_start;
        return $this;
    }

    /**
     * 订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。其他详见时间规则
    注意：最短失效时间间隔必须大于5分钟
     * @return string
     */
    public function getTimeExpire()
    {
        return $this->time_expire;
    }

    /**
     * 订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。其他详见时间规则
     * 注意：最短失效时间间隔必须大于5分钟
     * @param string $time_expire
     * @return WechatOrderParameter
     */
    public function setTimeExpire($time_expire = null)
    {
        if($time_expire !== null){
            $this->time_expire = $time_expire;
        }
        return $this;
    }

    /**
     * 商品标记，使用代金券或立减优惠功能时需要的参数
     * @link https://pay.weixin.qq.com/wiki/doc/api/tools/sp_coupon.php?chapter=12_1
     * @return string
     */
    public function getGoodsTag()
    {
        return $this->goods_tag;
    }

    /**
     * 商品标记，使用代金券或立减优惠功能时需要的参数
     * @link  https://pay.weixin.qq.com/wiki/doc/api/tools/sp_coupon.php?chapter=12_1
     * @param string $goods_tag
     * @return WechatOrderParameter
     */
    public function setGoodsTag($goods_tag = null)
    {
        if($goods_tag !== null){
            $this->goods_tag = $goods_tag;
        }
        return $this;
    }

    /**
     * 异步接收微信支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数。
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * 异步接收微信支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数。
     * @param string $notify_url
     * @return WechatOrderParameter
     */
    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;
        return $this;
    }

    /**
     * 取值如下：JSAPI，NATIVE，APP等，说明详见参数规定
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return string
     */
    public function getTradeType()
    {
        return $this->trade_type;
    }

    /**
     * 取值如下：JSAPI，NATIVE，APP等，说明详见参数规定
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param string $trade_type
     * @return WechatOrderParameter
     */
    public function setTradeType($trade_type = 'JSAPI')
    {
        $this->trade_type = $trade_type;
        return $this;
    }

    /**
     * trade_type=NATIVE时（即扫码支付），此参数必传。此参数为二维码中包含的商品ID，商户自行定义。
     * @return string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * trade_type=NATIVE时（即扫码支付），此参数必传。此参数为二维码中包含的商品ID，商户自行定义。
     * @param string $product_id
     * @return WechatOrderParameter
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * 上传此参数no_credit--可限制用户不能使用信用卡支付
     * @return string
     */
    public function getLimitPay()
    {
        return $this->limit_pay;
    }

    /**
     * 上传此参数no_credit--可限制用户不能使用信用卡支付
     * @param string $limit_pay
     * @return WechatOrderParameter
     */
    public function setLimitPay($limit_pay = null)
    {
        if($limit_pay !== null){
            $this->limit_pay = $limit_pay;
        }
        return $this;
    }

    /**
     * trade_type=JSAPI时（即公众号支付），此参数必传，此参数为微信用户在商户对应appid下的唯一标识。
     * @return string
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * trade_type=JSAPI时（即公众号支付），此参数必传，此参数为微信用户在商户对应appid下的唯一标识。
     * @param string $openid
     * @return WechatOrderParameter
     */
    public function setOpenid($openid = null)
    {
        if($openid !== null){
            $this->openid = $openid;
        }
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
        if(!array_key_exists('notify_url',$this->requestData)){
            $this->requestData['notify_url'] = $this->notify_url;
        }
        if(!array_key_exists('trade_type',$this->requestData)){
            $this->requestData['trade_type'] = 'JSAPI';
        }

        if(!array_key_exists('spbill_create_ip',$this->requestData)){
            $this->requestData['spbill_create_ip'] = $_SERVER['REMOTE_ADDR'];
        }
        if(!array_key_exists('time_start',$this->requestData)){
            $this->requestData['time_start'] = date('YmdHis');
        }
        if(!array_key_exists('device_info',$this->requestData)){
            $this->requestData['device_info'] = 'WEB';
        }

    }

    /**
     * 检查参数的完整性
     * @throws PaymentException
     */
    protected function checkDataParams()
    {
        if(!array_key_exists('appid',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 appid');
        }
        if(!array_key_exists('mch_id',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 mch_id');
        }
        if(!array_key_exists('notify_url',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 notify_url');
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
        if(!array_key_exists('trade_type',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 trade_type');
        }
        if($this->requestData['trade_type'] == 'JSAPI' && !array_key_exists('openid',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 openid');
        }
        if(!array_key_exists('spbill_create_ip',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 spbill_create_ip');
        }
    }
}