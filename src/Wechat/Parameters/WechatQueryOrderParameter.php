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
 *
 * @link https://pay.weixin.qq.com/wiki/doc/api/native.php?chapter=9_2
 *
 * @package Payment\Wechat\Parameters
 *
 */
class WechatQueryOrderParameter extends QueryOrderParameter
{
    use WechatParameterTrait;

    /**
     * 微信的订单号，建议优先使用
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * 微信的订单号，建议优先使用
     * @param string $transaction_id
     * @return WechatQueryOrderParameter
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }

    /**
     * 商户系统内部的订单号，请确保在同一商户号下唯一。
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    /**
     * 商户系统内部的订单号，请确保在同一商户号下唯一。
     * @param string $out_trade_no
     * @return WechatQueryOrderParameter
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
        return $this;
    }

    /**
     * @return string
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * @param string $sign_type
     * @return WechatQueryOrderParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
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