<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 10:38
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayDirectParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayDirectParameter($config->get('partner'));
$parameter->setOutTradeNo('8888888888');
$parameter->setSubject('测试订单');
$parameter->setTotalFee('0.01');
$parameter->setSellerId($config->get('partner'));
$parameter->setRsaPrivatePath($config->get('rsa_private_path'));

$provider = new AlipayPaymentClient($config);

$result = $provider->handle($parameter);

echo "<a href='{$result}' target='_blank'>支付</a>";