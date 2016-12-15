<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 15:28
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 支付宝钱包用户信息共享
 *
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.dmVpXA&apiId=876&docType=4
 *
 * @package Payment\Alipay\Parameters
 *
 * @property string $auth_token
 */
class AlipayAuthUserInfoParameter extends AbstractParameter
{
    protected $method = 'alipay.user.userinfo.share';
    use AlipayParameterTrait;
    protected $parameters = ['auth_token' => null];

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
     * @return string
     */
    public function getAuthToken()
    {
        return $this->parameters['auth_token'];
    }

    /**
     * @param string $auth_token
     */
    public function setAuthToken($auth_token)
    {
        $this->parameters['auth_token'] = $auth_token;
    }


}