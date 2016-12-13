<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 18:00
 */

namespace Payment\Alipay\Results;


use Payment\AbstractResult;

class AlipayTradeCloseResult extends AbstractResult
{
    public function __construct($response)
    {
        parent::__construct($response);
    }

    public function code()
    {
        // TODO: Implement code() method.
    }

    public function message()
    {
        // TODO: Implement message() method.
    }

    public function data()
    {
        // TODO: Implement data() method.
    }

}