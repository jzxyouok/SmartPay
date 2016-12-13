<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 13:20
 */

namespace Payment\Exceptions;

/**
 * 自定义的支付异常类
 * Class PaymentException
 * @package Payment\Exceptions
 */
class PaymentException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}