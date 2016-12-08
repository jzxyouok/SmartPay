<?php

namespace Payment;

/**
 * 支付结果响应对象
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 14:54
 */
abstract class AbstractResult
{
    protected $response;

    /**
     * 创建支付结果实例
     * Result constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * 响应数据的状态码
     * @return string
     */
    abstract public function code();

    /**
     * 响应的描述
     * @return string
     */
    abstract public function message();

    /**
     * 响应的数据
     * @return array
     */
    abstract public function data();
}