<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 15:03
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 支付宝会员授权信息查询接口
 * @link https://doc.open.alipay.com/docs/api.htm?spm=a219a.7395905.0.0.y1UOT0&docType=4&apiId=1218
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayAuthUserParameter extends AbstractParameter
{
    protected $method = 'alipay.user.info.share';
    use AlipayParameterTrait;

    protected $parameters = ['auth_token'=>null];

    protected function checkDataParams()
    {
        if(empty($this->parameters['auth_token'])){
            throw new PaymentException('auth_token 不能为空');
        }
    }

    protected function buildData()
    {
        $this->parameter->checkParams();

        $data = array_merge($this->parameter->getData(),$this->parameters);

        $params = [];

        foreach ($data as $key=>$value){
            if(empty($value)===false){
                $params[$key] = $value;
            }
        }

        $this->requestData = $data;
    }

    /**
     * 针对用户授权接口，获取用户相关数据时，用于标识用户授权关系。
     * @return string|null
     */
    public function getAuthToken()
    {
        return $this->parameters['auth_token'];
    }

    /**
     * 针对用户授权接口，获取用户相关数据时，用于标识用户授权关系。
     * @param $auth_token
     */
    public function setAuthToken($auth_token)
    {
        $this->parameters['auth_token'] = $auth_token;
    }
}