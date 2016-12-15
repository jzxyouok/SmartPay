<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 9:45
 */

namespace Payment\Alipay\Results;


use Payment\AbstractResult;

/**
 * 蚂蚁金服开放平台统一返回结果基类
 * @package Payment\Alipay\Results
 */
class AlipayTradeResult extends AbstractResult
{
    protected $responseData = [];

    public function __construct($response)
    {
        parent::__construct($response);
        if(isset($response['error_response'])){
            $this->responseData = $response['error_response'];
        }
    }

    /**
     * 网关返回码
     * @return string
     */
    public function code()
    {
        return array_value('code',$this->responseData);
    }

    /**
     * 网关返回码描述
     * @return string
     */
    public function message()
    {
        return array_value('msg',$this->responseData);
    }

    /**
     * 原始返回值
     * @return array
     */
    public function data()
    {
        return $this->response;
    }

    /**
     * 业务返回码
     * @return mixed|null
     */
    public function getSubCode()
    {
        return array_value('sub_code',$this->responseData);
    }

    /**
     * 业务返回码描述
     * @return mixed|null
     */
    public function getSubMsg()
    {
        return array_value('sub_msg',$this->responseData);
    }

    /**
     * 签名
     * @return mixed|null
     */
    public function getSign()
    {
        return array_value('sign',$this->response);
    }

    public function __toString()
    {
        return json_encode($this->response,JSON_UNESCAPED_UNICODE);
    }
}