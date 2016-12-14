<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 9:38
 */
require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayParameter;
use Payment\Alipay\Parameters\AlipayTradeQueryParameter;
use Payment\Alipay\Parameters\AlipayTradeRefundParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayParameter();
$parameter->initialize($config);

$params = new AlipayTradeRefundParameter($parameter);
$params->setOutTradeNo('9999999999');
$params->setRefundAmount('0.01');

$client = new AlipayPaymentClient($config);

$result = $client->handle($params);

var_dump($result);