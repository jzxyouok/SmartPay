<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 16:06
 */

namespace Payment\Wechat\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\ReverseParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 撤销订单
 *
 * 支付交易返回失败或支付系统超时，调用该接口撤销交易。如果此订单用户支付失败，微信支付系统会将此订单关闭；如果用户支付成功，微信支付系统会将此订单资金退还给用户。
 * 注意：7天以内的交易单可调用撤销，其他正常支付的单如需实现相同功能请调用申请退款API。提交支付交易后调用【查询订单API】，没有明确的支付结果再调用【撤销订单API】。
 *
 * @package Payment\Wechat\Parameters
 *
 */
class WechatReverseParameter extends ReverseParameter
{
    use WechatParameterTrait;

    /**
     * 微信的订单号，优先使用
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * 微信的订单号，优先使用
     * @param string $transaction_id
     * @return WechatReverseParameter
     */
    public function setTransactionId($transaction_id = null)
    {
        if($transaction_id !== null){
            $this->transaction_id = $transaction_id;
        }
        return $this;
    }

    /**
     * 商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no
     *
     * @param string $out_trade_no
     * @return WechatReverseParameter
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
        return time();
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
     * @return WechatReverseParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
        return time();
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
        if(!array_key_exists('sign_type',$this->requestData)){
            $this->requestData['sign_type'] = 'MD5';
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
            throw new PaymentException('提交被扫支付API接口中，transaction_id和out_trade_no 必须存在一个');
        }
    }

}