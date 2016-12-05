<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 10:37
 */

namespace Payment;


use Payment\Configuration\PayConfiguration;

class PaymentContext
{
    protected $config;

    public function __construct(PayConfiguration $config)
    {
        $this->config = $config;
    }

    public function handle(PaymentProvider $provider, AbstractParameter $parameters, $method)
    {
        return $provider->$method($parameters);
    }

    public function logs()
    {
        print_r($this->config);
    }
}