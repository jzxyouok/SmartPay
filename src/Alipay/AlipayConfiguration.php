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
    const ALIPAY_GATEWAY = 'https://mapi.alipay.com/gateway.do?';

    /**
     * 商家账号
     * @return null|string
     */
    public function getPartner()
    {
        return isset($this->config['partner'])? $this->config['partner'] : null;
    }
}