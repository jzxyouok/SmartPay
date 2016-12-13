<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/7 0007
 * Time: 17:50
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayWapOrderParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$params = new AlipayWapOrderParameter($config->partner);

$params->setOutTradeNo('88888888');
$params->setRsaPrivatePath($config->rsa_private_path);
$params->setSubject('测试');
$params->setNotifyUrl('https://www.baiyangwang.com');
$params->setKey($config->key);
$params->setTotalFee('0.01');
$params->setSellerId($config->get('partner'));
$params->setPaymentType('1');
$params->setShowUrl('https://www.baiyangwang.com');
$params->setSignType('RSA');

$provider = new AlipayPaymentClient($config);

$url = $provider->handle($params);

echo "<a href='$url' target='_blank'>支付</a>";