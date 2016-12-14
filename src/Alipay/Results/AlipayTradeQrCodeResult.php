<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 14:11
 */

namespace Payment\Alipay\Results;

/**
 * 统一收单线下交易预创建二维码结果
 * @package Payment\Alipay\Results
 */
class AlipayTradeQrCodeResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_trade_precreate_response'];
    }

    /**
     * 	商户的订单号
     * @return string|null
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->responseData);
    }

    /**
     * 	当前预下单请求生成的二维码码串，可以用二维码生成工具根据该码串值生成对应的二维码
     * @return null|string
     */
    public function getQrCode()
    {
        return array_value('qr_code',$this->responseData);
    }
}