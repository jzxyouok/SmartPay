<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:17
 */

namespace Payment\Alipay;


use Payment\AbstractNotify;

class AlipayNotify extends AbstractNotify
{
    protected function getRequestData()
    {
        $data = empty($_POST) ? $_GET : $_POST;
        if (empty($data) || ! is_array($data)) {
            return false;
        }
        return $data;
    }

    protected function verifySign()
    {

    }

    protected function reply($isSuccess, $message)
    {
        // TODO: Implement reply() method.
    }

}