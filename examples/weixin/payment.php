<?php

require_once __DIR__ . '/../../autoload.php';


use Payment\Wechat\Parameters\WechatCloseOrderParameter;
use Payment\Wechat\Parameters\WechatOrderParameter;
use Payment\Wechat\Parameters\WechatQrCodeParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentClient;


$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');


$client= new WechatPaymentClient($config);




$params = new WechatOrderParameter($config->appid,$config->mch_id,$config->key);
$params->setBody('测试订单');
$params->setNotifyUrl($config->notify_url);
$params->setOutTradeNo('1151026628743');
$params->total_fee = 1;
$params->trade_type = 'NATIVE';
$params->openid = 'ouAi1jjpoxo2Uy1ZIxUSXW-WLoBI';


$result = $client->handle($params);

var_dump($result);