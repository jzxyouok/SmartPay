<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 15:13
 */

namespace Payment\Alipay\Results;


class AlipayUserResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        if(isset($response['alipay_user_info_share_response'])){
            $this->responseData = $response['alipay_user_info_share_response'];
        }
    }
}