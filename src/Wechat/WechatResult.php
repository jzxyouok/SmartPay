<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:03
 */

namespace Payment\Wechat;

/**
 * 微信公众号支付结果
 * Class WechatPublicResult
 * @package Payment\Wechat
 */
class WechatResult extends \Result
{
    public function code()
    {
        return $this->response['return_code'];
    }

    public function message()
    {
        return $this->response['return_msg'];
    }

    function data()
    {
        return $this->response;
    }

}