<?php
/**
 * 扫码支付方法演示
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:05
 */

require_once __DIR__ . '/../autoload.php';

use Payment\Wechat\Parameters\WechatTradeParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentClient;


//初始化配置
$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');

$provider = new WechatPaymentClient($config);

$params = new WechatTradeParameter($config->appid,$config->mch_id,$config->key);

$params->body = 'a';
$params->out_trade_no = '1151026628743';
$params->total_fee = 1;
$params->auth_code = 'a';

$result = $provider->micropay($params);

var_dump($result);