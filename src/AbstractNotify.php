<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 17:18
 */

namespace Payment;

use Payment\Configuration\PayConfiguration;
use Payment\Exceptions\PaymentException;

/**
 * 第三方通知基类
 * Class AbstractNotify
 * @package Payment
 * @property PayConfiguration $config
 * @property array $requestData
 */
abstract class AbstractNotify
{
    protected $config;
    protected $requestData;

    public function __construct(PayConfiguration $config)
    {
        mb_internal_encoding("UTF-8");
        $this->config = $config;
        $this->requestData = $this->getRequestData();
    }

    /**
     * 处理第三方通知
     * @param NotifyInterface $notify
     * @return mixed
     * @throws PaymentException
     */
    final public function handle(NotifyInterface $notify)
    {
        //判断是否获取了数据
        if($this->requestData === false){
            throw new PaymentException('获取通知数据失败');
        }
        //校验数据是否合法
        $result = $this->verifySign($this->requestData);

        if($result === false){
            throw new PaymentException('签名校验失败');
        }
        //调用用户业务逻辑
        $processResult = $notify->process($this->requestData);
        //生成响应给第三方的数据
        return $this->reply($processResult);
    }

    /**
     * 获取第三方请求的数据库
     * @return array|bool
     */
    abstract protected function getRequestData();

    /**
     * 校验签名是否正确
     * @param array $data
     * @return bool
     */
    abstract protected function verifySign(array $data);

    /**
     * 将处理结果响应给第三方
     * @param $message
     * @return mixed
     */
    abstract protected function reply($message);
}