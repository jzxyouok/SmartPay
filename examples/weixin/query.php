<?php
/**
 * 微信订单查询演示
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 16:38
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Wechat\Parameters\WechatQueryOrderParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentClient;


$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');

$parameter = new WechatQueryOrderParameter($config->getAppId(),$config->getMchId(),$config->getKey());

$parameter->setOutTradeNo('1151026628743');

$client = new WechatPaymentClient($config);

$result = $client->handle($parameter);

var_dump($result);