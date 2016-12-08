<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 11:08
 */

namespace Payment\Alipay\Notices;


use Payment\AbstractNotify;
use Payment\Configuration\PayConfiguration;
use Payment\Exceptions\PaymentException;
use Payment\Support\Traits\AlipaySignTrait;

/**
 * 手机网页支付相关通知处理
 *
 * API文档： @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.Y4Khk5&treeId=60&articleId=104744&docType=1
 *
 * Class AlipayWapNotify
 * @package Payment\Alipay\Notices
 */
class AlipayWapNotify extends AbstractNotify
{
    use AlipaySignTrait;

    protected $requestData = array();

    public function __construct(PayConfiguration $config)
    {
        parent::__construct($config);
        $this->getRequestData();
    }

    /**
     * 通知发送的时间。
     * 格式为：yyyy-MM-dd HH:mm:ss。
     *
     * @return null
     */
    public function getNotifyTime()
    {
        return isset($this->requestData['notify_time']) ? $this->requestData['notify_time'] : null;
    }

    /**
     * 通知类型
     *
     * @return string|null
     */
    public function getNotifyType()
    {
        return isset($this->requestData['notify_type']) ? $this->requestData['notify_type'] : null;
    }

    /**
     * 通知校验ID
     * @return null|string
     */
    public function getNotifyId()
    {
        return isset($this->requestData['notify_id']) ? $this->requestData['notify_id'] : null;
    }

    /**
     * 签名方式
     *
     * DSA、RSA、MD5三个值可选，必须大写。
     *
     * @return null|string
     */
    public function getSignType()
    {
        return isset($this->requestData['sign_type']) ? $this->requestData['sign_type'] : null;
    }

    /**
     * 签名
     * @return null|string
     */
    public function getSign()
    {
        return isset($this->requestData['sign']) ? $this->requestData['sign'] : null;
    }

    /**
     * 获取请求的数据
     * @return array|bool
     */
    protected function getRequestData()
    {
        if(!empty($this->requestData)){
            return $this->requestData;
        }
        $data = empty($_POST) ? $_GET : $_POST;
        if (empty($data) || ! is_array($data)) {
            return false;
        }
        $this->requestData = $data;
        return $data;
    }

    /**
     * 校验通知是否合法
     * @return bool
     */
    protected function verifySign()
    {
        $data = $this->requestData;
        unset($this->requestData['sign']);
        unset($this->requestData['sign_type']);

        $sign = $this->createSign();
        if(strcasecmp($sign,$this->getSign()) !== 0){
            return false;
        }

        $url = $this->config->get('wap_alipay_url') .'?service=notify_verify&partner='. $this->config->get('partner') . '&notify_id=' . $this->getNotifyId() . '&_input_charset=' . $this->config->get('charset');


        $result = $this->post(null,$url,30,$this->config->get('sslcert'));

        if(strcasecmp($result,'true') === 0){
            return true;
        }
        $this->requestData = $data;

        return false;
    }

    /**
     * 返回响应给客户端的数据
     * @param bool $isSuccess
     * @param string $message
     * @return string
     */
    protected function reply($isSuccess, $message)
    {
        return $isSuccess ? 'success' : 'fail';
    }

    protected function getRsaPrivatePath()
    {
        return $this->config->get('rsa_private_path');
    }

}