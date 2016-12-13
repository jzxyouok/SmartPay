<?php
header('Content-Type:text/html;charset=utf-8;');
/**
 * 统一收单线下交易查询
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 17:15
 */
require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayParameter;
use Payment\Alipay\Parameters\AlipayTradeQueryParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayParameter();
$parameter->initialize($config);

$params = new AlipayTradeQueryParameter($parameter);
$params->setOutTradeNo('9999999999');

$client = new AlipayPaymentClient($config);

$result = $client->handle($params);

var_dump($result);