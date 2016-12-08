<?php

require_once __DIR__ . '/../autoload.php';

use Payment\Wechat\Parameters\WechatRefundParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentProvider;


//初始化配置
$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');

$provider = new WechatPaymentProvider($config);

$params = new WechatRefundParameter($config->appid,$config->mch_id,$config->key);
$params->out_trade_no = '1151026628743';
$params->out_refund_no = 'TK1151026628743';
$params->total_fee = 1;
$params->refund_fee = 1;


$result = $provider->refund($params);

var_dump($result);