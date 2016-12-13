<?php
/**
 * 蚂蚁金服 统一收单交易支付接口
 *
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 14:04
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayParameter;
use Payment\Alipay\Parameters\AlipayTradeParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayParameter();
$parameter->initialize($config);

$params = new AlipayTradeParameter($parameter);
$params->setOutTradeNo('8888888888888');
$params->setSubject('测试订单');
$params->setTotalAmount('0.01');
$params->setScene('5454');
$params->setAuthCode('28763443825664394');


$client = new AlipayPaymentClient($config);

$result = $client->handle($params);

print_r($result);