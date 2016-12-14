<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:15
 */

namespace Payment\Alipay;


use Payment\Configuration\PayConfiguration;

/**
 * 支付宝配置文件
 * Class AlipayConfiguration
 * @package Payment\Alipay
 */
class AlipayConfiguration extends PayConfiguration
{
    /**
     * 旧版支付宝支付接口网关
     */
    const ALIPAY_GATEWAY = 'https://mapi.alipay.com/gateway.do?';
    /**
     * 新版蚂蚁金服支付宝网关
     */
    const OPEN_ALIPAY_GATEWAY = 'https://openapi.alipay.com/gateway.do';

    /**
     * 商家账号
     * @return null|string
     */
    public function getPartner()
    {
        return isset($this->config['partner'])? $this->config['partner'] : null;
    }
    public function getRsaPrivatePath()
    {
        return array_value('rsa_private_path',$this->config);
    }
    public function getOpenRsaPrivatePath()
    {
        return array_value('open_rsa_private_path',$this->config);
    }
    public function getOpenRsaPublicPath()
    {
        return array_value('open_rsa_public_path  ',$this->config);
    }
    public function getKey()
    {
        return array_value('key',$this->config);
    }
}
