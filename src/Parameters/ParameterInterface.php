<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 13:01
 */

namespace Payment\Parameters;

/**
 * 参数接口
 * Interface ParameterInterface
 * @package Payment\Parameters
 */
interface ParameterInterface
{
    /**
     * 获取请求的参数原始数据
     * @return mixed
     */
    public function getRequestData();
    /**
     * 生成签名
     */
    public function sign();
}