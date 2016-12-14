<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 18:00
 */

namespace Payment\Alipay\Results;



class AlipayTradeCloseResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_trade_close_response'];
    }

    /**
     * 支付宝交易号
     * @return string|null
     */
    public function getTradeNo()
    {
        return array_value('trade_no',$this->responseData);
    }

    /**
     * 创建交易传入的商户订单号
     * @return string|null
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->responseData);
    }

}