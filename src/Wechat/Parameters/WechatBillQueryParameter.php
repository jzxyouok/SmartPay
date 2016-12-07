<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 16:09
 */

namespace Payment\Wechat\Parameters;

use Payment\Exceptions\PaymentException;
use Payment\Parameters\BillParameter;
use Payment\Support\Traits\WechatParameterTrait;

/**
 * 下载对账单
 *
 * 商户可以通过该接口下载历史交易清单。比如掉单、系统错误等导致商户侧和微信侧数据不一致，通过对账单核对后可校正支付状态。
 * 注意：
 * 1、微信侧未成功下单的交易不会出现在对账单中。支付成功后撤销的交易会出现在对账单中，跟原支付单订单号一致，bill_type为REVOKED；
 * 2、微信在次日9点启动生成前一天的对账单，建议商户10点后再获取；
 * 3、对账单中涉及金额的字段单位为“元”。
 * 4、对账单接口只能下载三个月以内的账单。
 *
 * @package Payment\Wechat\Parameters
 *
 */
class WechatBillQueryParameter extends BillParameter
{
    use WechatParameterTrait;

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
     * @return  WechatBillQueryParameter
     */
    public function setSignType($sign_type = 'MD5')
    {
        $this->sign_type = $sign_type;
        return $this;
    }

    /**
     *  微信支付分配的终端设备号
     * @return string
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     *  微信支付分配的终端设备号
     * @param string $device_info
     * @return  WechatBillQueryParameter
     */
    public function setDeviceInfo($device_info = null)
    {
        if($device_info !== null){
            $this->device_info = $device_info;
        }
        return $this;
    }

    /**
     * 下载对账单的日期，格式：20140603
     * @return string
     */
    public function getBillDate()
    {
        return $this->bill_date;
    }

    /**
     * 下载对账单的日期，格式：20140603
     *
     * @param string $bill_date
     *  @return  WechatBillQueryParameter
     */
    public function setBillDate($bill_date)
    {
        $this->bill_date = $bill_date;
        return $this;
    }

    /**
     * 账单类型
     *
     * ALL，返回当日所有订单信息，默认值
     * SUCCESS，返回当日成功支付的订单
     * REFUND，返回当日退款订单
     *
     * @return string
     */
    public function getBillType()
    {
        return $this->bill_type;
    }

    /**
     * 账单类型
     *
     * ALL，返回当日所有订单信息，默认值
     * SUCCESS，返回当日成功支付的订单
     * REFUND，返回当日退款订单
     *
     * @param string $bill_type
     *  @return  WechatBillQueryParameter
     */
    public function setBillType($bill_type = 'ALL')
    {
        $this->bill_type = $bill_type;
        return $this;
    }

    /**
     * 压缩账单
     *
     * 非必传参数，固定值：GZIP，返回格式为.gzip的压缩包账单。不传则默认为数据流形式。
     *
     * @return string
     */
    public function getTarType()
    {
        return $this->tar_type;
    }

    /**
     * 压缩账单
     *
     * 非必传参数，固定值：GZIP，返回格式为.gzip的压缩包账单。不传则默认为数据流形式。
     *
     * @param string $tar_type
     * @return  WechatBillQueryParameter
     */
    public function setTarType($tar_type = null)
    {
        if($tar_type !== null){
            $this->tar_type = $tar_type;
        }

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
        if(!array_key_exists('bill_date',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 bill_date');
        }
        if(!array_key_exists('bill_type',$this->requestData)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 bill_type');
        }
    }

}