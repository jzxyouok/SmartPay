<?php
/**
 * 蚂蚁金服 新版手机网页支付演示
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 15:15
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayParameter;
use Payment\Alipay\Parameters\AlipayTradeParameter;
use Payment\Alipay\Parameters\AlipayTradeWapParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayParameter();
$parameter->initialize($config);

$params = new AlipayTradeWapParameter($parameter);
$params->setSubject('测试订单');
$params->setOutTradeNo('9999999999');
$params->setTotalAmount('0.01');
$params->setProductCode('QUICK_WAP_PAY');


$client = new AlipayPaymentClient($config);

$result = $client->handle($params);


echo "<a href='{$result}' target='_blank'>支付</a>";