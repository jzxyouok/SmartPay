<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 11:30
 */

namespace Payment\Alipay\Results;

/**
 * Class AlipayTokenResult
 * @package Payment\Alipay\Results
 * @property string $user_id
 * @property string $access_token
 * @property string $expires_in
 * @property string $refresh_token
 * @property string $re_expires_in
 *
 */
class AlipayTokenResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        if(isset($response['alipay_system_oauth_token_response'])){
            $this->responseData = $this->response['alipay_system_oauth_token_response'];
        }

    }

    /**
     * 支付宝用户的唯一userId
     * @return string
     */
    public function getUserId()
    {
        return array_value('user_id',$this->responseData);
    }

    /**
     * 访问令牌。通过该令牌调用需要授权类接口
     * @return string
     */
    public function getAccessToken()
    {
        return array_value('access_token',$this->responseData);
    }

    /**
     * 	访问令牌的有效时间，单位是秒。
     * @return string
     */
    public function getExpiresIn()
    {
        return array_value('expires_in',$this->responseData);
    }

    /**
     * 刷新令牌。通过该令牌可以刷新access_token
     * @return string
     */
    public function getRefreshToken()
    {
        return array_value('refresh_token',$this->responseData);
    }

    /**
     * 刷新令牌的有效时间，单位是秒。
     * @return string
     */
    public function getReExpiresIn()
    {
        return array_value('re_expires_in',$this->responseData);
    }


}