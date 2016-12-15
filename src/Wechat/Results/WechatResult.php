<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:03
 */

namespace Payment\Wechat\Results;

use Payment\AbstractResult;

/**
 * 微信公众号支付结果
 * Class WechatPublicResult
 * @package Payment\Wechat
 *
 */
class WechatResult extends AbstractResult
{
    public function __construct($response)
    {
        if(is_array($response)){
            parent::__construct($response);
        }elseif(substr($response, 0 , 5) == "<xml>"){
            $response = convert_xml_to_array($response);

            parent::__construct($response);
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


}