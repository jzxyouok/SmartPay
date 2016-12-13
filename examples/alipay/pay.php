<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/7 0007
 * Time: 11:27
 */

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayParameter;
use Payment\Alipay\Parameters\AlipayTradeParameter;

require_once __DIR__ . '/../../autoload.php';

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$common = new AlipayParameter();
$common->initialize($config);


$params = new AlipayTradeParameter($common);
$params->setOutTradeNo('88888888');
$params->setScene('aaa');
$params->setAuthCode('28763443825664394');
$params->setSubject('aaa');

$provider = new AlipayPaymentClient($config);


$result = $provider->micropay($params);

var_dump($result);