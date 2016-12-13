<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/7 0007
 * Time: 14:03
 */

namespace Payment\Alipay\Parameters;

use Payment\Exceptions\PaymentException;

/**
 * 支付宝 trade 类型接口公共请求参数
 * Class AlipayParameter
 * @package Payment\Alipay\Parameters
 */
class AlipayParameter
{
    public function __construct()
    {
        $this->setFormat('JSON');
        $this->setCharset('utf-8');
        $this->setSignType('RSA');
        $this->setTimestamp(date('Y-m-d H:i:s'));
        $this->setVersion('1.0');
    }

    /**
     * 初始化公共参数
     * @param array|object $param
     */
    public function initialize($param)
    {
        if(is_array($param)){
            isset($param['appid']) and $this->setAppId($param['appid']);
            isset($param['format']) and $this->setFormat($param['format']);
            isset($param['key']) and $this->setKey($param['key']);
            isset($param['charset']) and $this->setCharset($param['charset']);
            isset($param['sign_type']) and $this->setSignType($param['sign_type']);
            isset($param['timestamp']) and $this->setTimestamp($param['timestamp']);
            isset($param['version']) and $this->setVersion($param['version']);
            isset($param['notify_url']) and $this->setVersion($param['notify_url']);
            isset($param['app_auth_token']) and $this->setVersion($param['app_auth_token']);
            isset($param['open_rsa_private_path']) and $this->setVersion($param['open_rsa_private_path']);
            isset($param['open_rsa_public_path']) and $this->setVersion($param['open_rsa_public_path']);
        }elseif (is_object($param)){
            isset($param->appid) and $this->setAppId($param->appid);
            isset($param->format) and $this->setFormat($param->format);
            isset($param->key) and $this->setKey($param->key);
            isset($param->charset) and $this->setCharset($param->charset);
            isset($param->sign_type) and $this->setSignType($param->sign_type);
            isset($param->timestamp) and $this->setTimestamp($param->timestamp);
            isset($param->version) and $this->setVersion($param->version);
            isset($param->notify_url) and $this->setNotifyUrl($param->notify_url);
            isset($param->app_auth_token) and $this->setAppAuthToken($param->app_auth_token);
            isset($param->open_rsa_private_path) and $this->setRsaPrivatePath($param->open_rsa_private_path);
            isset($param->open_rsa_public_path) and $this->setRsaAliPubPath($param->open_rsa_public_path);

        }
    }
    /**
     * 支付宝分配给开发者的应用ID
     * @param $appid
     * @return $this
     */
    public function setAppId($appid)
    {
        $this->appid = $appid;
        return $this;
    }

    /**
     * 支付宝分配给开发者的应用ID
     * @return string
     */
    public function getAppId()
    {
        return $this->appid;
    }

    /**
     * 	接口名称
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * 	接口名称
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * 仅支持JSON
     * @param string $format
     * @return $this
     */
    public function setFormat($format = 'JSON')
    {
        $this->format = $format;
        return $this;
    }

    /**
     * 仅支持JSON
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * 设置MD5模式下的私钥
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * 获取MD5模式下的私钥
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * 请求使用的编码格式，如utf-8,gbk,gb2312等
     * @param string $charset
     * @return $this
     */
    public function setCharset($charset = 'utf-8')
    {
        $this->charset = strtoupper($charset);
        return $this;
    }

    /**
     * 请求使用的编码格式，如utf-8,gbk,gb2312等
     * @return mixed
     */
    public function getCharset()
    {
        return  $this->charset;
    }

    /**
     * 商户生成签名字符串所使用的签名算法类型，目前支持RSA
     * @param string $sign_type
     * @return $this
     */
    public function setSignType($sign_type = 'RSA')
    {
        $this->sign_type = $sign_type;
        return $this;
    }

    /**
     * 商户生成签名字符串所使用的签名算法类型，目前支持RSA
     * @return mixed
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * 发送请求的时间，格式"yyyy-MM-dd HH:mm:ss"
     * @param $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp = null)
    {
        if($timestamp === null){
            $timestamp = date('Y-m-d H:i:s');
        }
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * 发送请求的时间，格式"yyyy-MM-dd HH:mm:ss"
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * 调用的接口版本，固定为：1.0
     * @param $version
     * @return $this
     */
    public function setVersion($version = '1.0')
    {
        $this->version = $version;
        return $this;
    }

    /**
     * 调用的接口版本，固定为：1.0
     *
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * 支付宝服务器主动通知商户服务器里指定的页面http/https路径。
     * @param $notify_url
     * @return $this
     */
    public function setNotifyUrl($notify_url = null)
    {
        $this->notify_url = $notify_url;
        return $this;
    }

    /**
     * 支付宝服务器主动通知商户服务器里指定的页面http/https路径。
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * 第三方应用授权
     * @link https://doc.open.alipay.com/doc2/detail.htm?treeId=216&articleId=105193&docType=1
     * @param null $app_auth_token
     * @return $this
     */
    public function setAppAuthToken($app_auth_token = null)
    {
        $this->app_auth_token = $app_auth_token;
        return $this;
    }

    /**
     * 第三方应用授权
     * @link https://doc.open.alipay.com/doc2/detail.htm?treeId=216&articleId=105193&docType=1
     * @return mixed
     */
    public function getAppAuthToken()
    {
        return $this->app_auth_token;
    }

    /**
     * 设置RSA模式下的私钥路径
     * @param $rsa_private_path
     * @return $this
     */
    public function setRsaPrivatePath($rsa_private_path)
    {
        $this->rsa_private_path = $rsa_private_path;
        return $this;
    }

    public function setRsaAliPubPath ($rsa_public_path)
    {
        $this->rsa_public_path = $rsa_public_path;
        return $this;
    }
    public function getRsaAliPubPath ()
    {
        return $this->rsa_public_path;
    }

    /**
     * 获取待签名的数组
     * @return array
     */
    public function getData()
    {
        $params = [
            'app_id' => $this->getAppId(),
            'format' => $this->getFormat(),
            'charset' => $this->getCharset(),
            'sign_type' => $this->getSignType(),
            'timestamp' => $this->getTimestamp(),
            'version'   => $this->getVersion(),
            'method'    => $this->getMethod(),
            'biz_content' => ''
        ];

        if(isset($this->notify_url) && !empty($this->notify_url)){
            $params['notify_url'] = $this->getNotifyUrl();
        }
        if(isset($this->app_auth_token) && !empty($this->app_auth_token)){
            $params['app_auth_token'] = $this->getAppAuthToken();
        }

        return $params;
    }

    /**
     * 检查参数是否完整
     * @return bool
     * @throws PaymentException
     */
    public function checkParams()
    {
        if(!isset($this->appid) || empty($this->appid)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 appid');
        }

        if(!isset($this->format) || empty($this->format)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 format');
        }
        if(!isset($this->charset) || empty($this->charset)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 charset');
        }
        if(!isset($this->sign_type) || empty($this->sign_type)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 sign_type');
        }
        if(!isset($this->timestamp) || empty($this->timestamp)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 timestamp');
        }
        if(!isset($this->version) || empty($this->version)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 version');
        }
        return true;
    }
    /**
     * 获取RSA模式下的私钥路径
     * @return mixed
     */
    public function getRsaPrivatePath()
    {
        return $this->rsa_private_path;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        if(isset($this->$name)){
            return $this->$name;
        }
        return null;
    }
}