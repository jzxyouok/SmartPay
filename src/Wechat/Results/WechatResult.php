<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:03
 */

namespace Payment\Wechat\Results;

use Payment\AbstractResult;
use Payment\Exceptions\PaymentException;

/**
 * 微信公众号支付结果
 * Class WechatPublicResult
 * @package Payment\Wechat
 *
 */
class WechatResult extends AbstractResult
{
    /**
     * @var array 缓存一些数据
     */
    protected $cache = array();

    public function __construct($response)
    {
        if(is_array($response)){
            parent::__construct($response);
        }elseif(substr($response, 0 , 5) == "<xml>"){
            $response = convert_xml_to_array($response);

            parent::__construct($response);
        }else{
            throw new PaymentException($response);
        }

    }

    public function code()
    {
        return $this->response['return_code'];
    }

    public function message()
    {
        return $this->response['return_msg'];
    }

    function data()
    {
        return $this->response;
    }

    /**
     * 调用接口提交的公众账号ID
     * @return string
     */
    public function getAppid()
    {
        return array_value('appid',$this->response);
    }

    /**
     * 调用接口提交的商户号
     * @return string
     */
    public function getMchId()
    {
        return array_value('mch_id',$this->response);
    }

    /**
     * 微信返回的随机字符串
     * @return string
     */
    public function getNonceStr()
    {
        return array_value('nonce_str',$this->response);
    }

    /**
     * 微信返回的签名值
     * @return string
     */
    public function getSign()
    {
        return array_value('sign',$this->response);
    }

    /**
     * 业务结果 SUCCESS/FAIL
     * @return string
     */
    public function getResultCode()
    {
        return array_value('result_code',$this->response);
    }

    /**
     * 错误代码
     *
     * @return string
     */
    public function getErrCode()
    {
        return array_value('err_code',$this->response);
    }

    /**
     * 错误代码描述
     * @return string
     */
    public function getErrCodeDes()
    {
        return array_value('err_code_des',$this->response);
    }

    /**
     * 获取值，如果不存在则返回默认值
     * @param string $name 键名
     * @param mixed|null $default 默认值
     * @return mixed|null
     */
    protected function getValue($name,$default = null)
    {
        return array_value($name,$this->response,$default);
    }
    /**
     * 获取多下标的数组数据
     * @param string $name 匹配名称
     * @param null $pattern 需要的正则匹配
     * @return array|null
     */
    protected function matchValue($name,$pattern = null)
    {
        if(isset($this->cache['array_' . $name])){
            return $this->cache['array_' .$name];
        }
        $results = [];
        foreach ($this->response as $key=>$value){
            if(stripos($key,$name) === 0){
                if($pattern !== null){
                    if(preg_match($pattern,$key)){
                        $results[$key] = $value;
                    }
                }else{
                    $results[$key] = $value;
                }
            }
        }
        $this->cache['array_' .$name] = $results;
        return $results;
    }

}