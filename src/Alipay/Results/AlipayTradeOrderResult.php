<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 15:34
 */

namespace Payment\Alipay\Results;


class AlipayTradeOrderResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_trade_pay_response'];
    }
}