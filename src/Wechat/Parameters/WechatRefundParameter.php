<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:58
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\RefundParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * Class WechatRefundParameter
 * @package Payment\Wechat\Parameters
 * @property string $appid 微信分配的公众账号ID（企业号corpid即为此appId）
 * @property string $mch_id 微信支付分配的商户号
 * @property string $device_info 终端设备号(门店号或收银设备ID)，注意：PC网页或公众号内支付请传"WEB"
 * @property string $out_trade_no 商户系统内部的订单号,32个字符内、可包含字母
 * @property string $nonce_str 随机字符串，不长于32位。
 * @property string $sign 签名
 * @property string $sign_type 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
 * @property string $transaction_id 微信的订单号，优先使用
 * @property string $out_refund_no 商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔
 * @property int $total_fee 订单总金额，单位为分，只能为整数
 * @property int $refund_fee 退款总金额，订单总金额，单位为分，只能为整数
 * @property string $refund_fee_type 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY
 * @property string $op_user_id  操作员帐号, 默认为商户号
 * @property string $refund_account 仅针对老资金流商户使用 : REFUND_SOURCE_UNSETTLED_FUNDS---未结算资金退款（默认使用未结算资金退款） / REFUND_SOURCE_RECHARGE_FUNDS---可用余额退款
 *
 */
class WechatRefundParameter extends RefundParameter
{
    use WechatParameterTrait;

    /**
     * 终端设备号
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * 终端设备号
     * @param string $device_info
     * @return WechatRefundParameter
     */
    public function setDeviceInfo($device_info = null)
    {
        if($device_info !== null){
            $this->device_info = $device_info;
        }
        return $this;
    }

    /**
     * 商户侧传给微信的订单号
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户侧传给微信的订单号
     * @param string $out_trade_no
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
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
     * @return WechatRefundParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
        return $this;
    }

    /**
     * 微信生成的订单号，在支付通知中有返回
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * 微信生成的订单号，在支付通知中有返回
     * @param string $transaction_id
     * @return WechatRefundParameter
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }

    /**
     * 商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔
     * @return string
     */
    public function getOutRefundNo()
    {
        return $this->out_refund_no;
    }

    /**
     * 商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔
     * @param string $out_refund_no
     * @return WechatRefundParameter
     */
    public function setOutRefundNo($out_refund_no)
    {
        $this->out_refund_no = $out_refund_no;
        return $this;
    }

    /**
     * 订单总金额，单位为分，只能为整数，详见支付金额
     * @link  https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return int
     */
    public function getTotalFee()
    {
        return $this->total_fee;
    }

    /**
     * 订单总金额，单位为分，只能为整数，详见支付金额
     * @link  https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param int $total_fee
     * @return WechatRefundParameter
     */
    public function setTotalFee($total_fee)
    {
        $this->total_fee = $total_fee;
        return $this;
    }

    /**
     * 退款总金额，订单总金额，单位为分，只能为整数，详见支付金额
     * @link  https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return int
     */
    public function getRefundFee()
    {
        return $this->refund_fee;
    }

    /**
     * 退款总金额，订单总金额，单位为分，只能为整数，详见支付金额
     * @link  https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param int $refund_fee
     * @return WechatRefundParameter
     */
    public function setRefundFee($refund_fee)
    {
        $this->refund_fee = $refund_fee;
        return $this;
    }

    /**
     * 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @return string
     */
    public function getRefundFeeType()
    {
        return $this->refund_fee_type;
    }

    /**
     * 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_2
     * @param string $refund_fee_type
     * @return WechatRefundParameter
     */
    public function setRefundFeeType($refund_fee_type = 'CNY')
    {
        $this->refund_fee_type = $refund_fee_type;
        return $this;
    }

    /**
     * 操作员帐号, 默认为商户号
     * 货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @return string
     */
    public function getOpUserId()
    {
        return $this->op_user_id;
    }

    /**
     * 操作员帐号, 默认为商户号
     * @param string $op_user_id
     * @return WechatRefundParameter
     */
    public function setOpUserId($op_user_id = null)
    {
        if($op_user_id === null){
            $op_user_id = $this->getMchId();
        }
        $this->op_user_id = $op_user_id;
        return $this;
    }

    /**
     * 仅针对老资金流商户使用
     * REFUND_SOURCE_UNSETTLED_FUNDS---未结算资金退款（默认使用未结算资金退款）
     * REFUND_SOURCE_RECHARGE_FUNDS---可用余额退款
     * @return string
     */
    public function getRefundAccount()
    {
        return $this->refund_account;
    }

    /**
     * 仅针对老资金流商户使用
     * REFUND_SOURCE_UNSETTLED_FUNDS---未结算资金退款（默认使用未结算资金退款）
     * REFUND_SOURCE_RECHARGE_FUNDS---可用余额退款
     * @param string $refund_account
     * @return WechatRefundParameter
     */
    public function setRefundAccount($refund_account = null)
    {
        if($refund_account !== null){
            $this->refund_account = $refund_account;
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
        if(!array_key_exists('sign_type',$this->requestData)){
            $this->requestData['sign_type'] = 'MD5';
        }
        if(!array_key_exists('op_user_id',$this->requestData)){
            $this->requestData['op_user_id'] = $this->mch_id;
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

        if(!array_key_exists('transaction_id',$this->requestData) && !array_key_exists('out_trade_no',$this->requestData)){
            throw new PaymentException('订单查询接口中，out_trade_no、transaction_id至少填一个');
        }
        if(!array_key_exists('out_refund_no',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 out_refund_no');
        }
        if(!array_key_exists('total_fee',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 total_fee');
        }
        if(!array_key_exists('refund_fee',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 refund_fee');
        }

    }

}