<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 10:49
 */

namespace Payment\Configuration;

use BadMethodCallException;
use Payment\PaymentProvider;

/**
 * 支付配置基类
 * Class PayConfiguration
 * @package Payment\Configuration
 */
abstract class PayConfiguration
{
    protected $config = array();

    /**
     * 根据指定路径或数组初始化配置
     * @param string|array $path 配置文件路径或配置数组
     */
    public function initialize($path)
    {
        if(is_array($path)){
            $this->config = $path;
        }else {
            $this->config = require_once $path;
        }
    }
    /**
     * 获取指定键的值
     * @param string $key 键名
     * @return mixed|null
     */
    public function get($key)
    {
        if (key_exists($key, $this->config)) {
            return $this->config[$key];
        }
        return null;
    }

    /**
     * 禁止调用未定义方法
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method [$method] does not exist.");
    }
}