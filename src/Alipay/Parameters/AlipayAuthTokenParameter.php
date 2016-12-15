<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 11:21
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * App用户登录换取授权访问令牌
 *
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.k4e1Tr&apiId=1025&docType=4
 *
 * @package Payment\Alipay\Parameters
 *
 * @property string $refresh_token
 */
class AlipayAuthTokenParameter extends AbstractParameter
{
    protected $method = 'alipay.system.oauth.token';
    use AlipayParameterTrait;
    protected $parameters = [
        'grant_type' => 'authorization_code',
        'code'          => null,
        'refresh_token' => null
    ];

    protected function buildData()
    {
        $this->parameter->checkParams();

        $data = $this->parameter->getData();
        $params = [];

        foreach ($this->parameters as $key=>$value){
            if(empty($value)===false){
                $params[$key] = $value;
            }
        }


        foreach ($data as $key=>$value){
            if(empty($value)===false){
                $params[$key] = $value;
            }
        }
        $this->requestData = $params;
    }

    protected function checkDataParams()
    {
        if(empty($this->parameters['grant_type'])){
            throw new PaymentException('grant_type 不能为空');
        }
    }


    /**
     * 值为authorization_code时，代表用code换取；值为refresh_token时，代表用refresh_token换取
     * @return string
     */
    public function getGrantType()
    {
        return $this->parameters['grant_type'];
    }

    /**
     * 值为authorization_code时，代表用code换取；值为refresh_token时，代表用refresh_token换取
     * @param string $grant_type
     */
    public function setGrantType($grant_type = 'authorization_code')
    {
        $this->parameters['grant_type'] = $grant_type;
    }

    /**
     * 	授权码，用户对应用授权后得到。
     * @return string
     */
    public function getCode()
    {
        return $this->parameters['code'];
    }

    /**
     * 	授权码，用户对应用授权后得到。
     * @param string $code
     */
    public function setCode($code)
    {
        $this->parameters['code'] = $code;
    }

    /**
     * 刷新令牌，上次换取访问令牌时得到。见出参的refresh_token字段
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->parameters['refresh_token'];
    }

    /**
     * 刷新令牌，上次换取访问令牌时得到。见出参的refresh_token字段
     * @param string $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->parameters['refresh_token'] = $refresh_token;
    }

    public function __toString()
    {
        return json_encode($this->parameters);
    }
}