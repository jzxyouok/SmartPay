<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 9:30
 */
namespace Payment\Support\Traits;

trait AlipayWapParameterTrait
{
    use AlipaySignTrait;
    protected $rsa_private_path = '';

    /**
     * 商户网站使用的编码格式，仅支持UTF-8。
     * @param $charset
     * @return $this
     */
    public function setCharset($charset)
    {
        $this->parameters['_input_charset'] = strtoupper($charset);
        return $this;
    }

    /**
     * 商户网站使用的编码格式，仅支持UTF-8。
     * @return mixed
     */
    public function getCharset()
    {
        return $this->parameters['_input_charset'];
    }

    /**
     * DSA、RSA、MD5三个值可选，必须大写。
     * @param $sign_type
     * @return $this
     */
    public function setSignType($sign_type)
    {
        $this->parameters['sign_type'] = strtoupper($sign_type);
        return $this;
    }

    /**
     * DSA、RSA、MD5三个值可选，必须大写。
     * @return mixed
     */
    public function getSignType()
    {
        return $this->parameters['sign_type'];
    }

    /**
     * 支付宝服务器主动通知商户网站里指定的页面http路径。
     * @param $notify_url
     * @return $this
     */
    public function setNotifyUrl($notify_url)
    {
        $this->parameters['notify_url'] = $notify_url;
        return $this;
    }

    /**
     * 支付宝服务器主动通知商户网站里指定的页面http路径。
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->parameters['notify_url'] ;
    }

    /**
     * 支付宝处理完请求后，当前页面自动跳转到商户网站里指定页面的http路径。
     * @param $return_url
     * @return $this
     */
    public function setReturnUrl($return_url)
    {
        $this->parameters['return_url'] = $return_url;
        return $this;
    }

    /**
     * 支付宝处理完请求后，当前页面自动跳转到商户网站里指定页面的http路径。
     * @return mixed
     */
    public function getReturnUrl()
    {
        return  $this->parameters['return_url'];
    }

    public function setKey($key)
    {
        $this->parameters['key'] = $key;
        return $this;
    }
    public function getKey()
    {
        return  $this->parameters['key'];
    }

    public function setRsaPrivatePath($rsa_private_path){
        $this->rsa_private_path = $rsa_private_path;
        return $this;
    }
    public function getRsaPrivatePath()
    {
        return $this->rsa_private_path;
    }

    /**
     * 填充和过滤数据
     */
    protected function buildData()
    {
        $params = array();

        foreach ($this->parameters as $key=>$value){
            if($key == 'sign' || $key == 'sign_type' || $value == '' || $value == null){
                continue;
            }
            $params[$key] = $value;
        }

        $this->requestData = $params;

    }

}