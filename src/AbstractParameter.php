<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 13:14
 */

namespace Payment;

use Payment\Configuration\PayConfiguration;
use Payment\Exceptions\PaymentException;


/**
 * 参数基类
 * Class Parameters
 * @package Payment
 */
abstract class AbstractParameter
{
    /**
     * @var PayConfiguration 支付配置信息
     */
    protected $config;
    /**
     * @var array 请求的数据
     */
    protected $requestData;
    /**
     * @var array 响应的数据
     */
    protected $responseData;

    public function __construct(PayConfiguration $config)
    {
        $this->config = $config;
    }

    /**
     * 获取变量，通过魔术方法
     * @param string $name
     * @return null|string
     * @author helei
     */
    public function __get($name)
    {
        if (isset($this->requestData[$name])) {
            return $this->requestData[$name];
        }
        return null;
    }
    /**
     * 设置变量
     * @param $name
     * @param $value
     * @author helei
     */
    public function __set($name, $value)
    {
        $this->requestData[$name] = $value;
    }

    public function sign()
    {
        //组织请求的数据
        $this->buildData();
        //检查数据的完整性
        $this->checkDataParams();
        //创建加密字符串
        $this->requestData['sign'] = $this->createSign();
    }

    /**
     * 获取请求数据
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * 生成用于支付的签名相关数据
     * @return array
     */
    abstract protected function buildData();
    /**
     * 签名算法实现  便于后期扩展微信不同的加密方式
     * @return string
     */
    abstract protected function createSign();

    /**
     * 检查传入的参数. $reqData是否正确.
     * @return mixed
     * @throws PaymentException
     */
    abstract protected function checkDataParams();
}
