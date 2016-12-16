<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/7 0007
 * Time: 9:39
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Wechat\Parameters\WechatCloseOrderParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentClient;

//初始化配置信息
$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');

//初始化对应接口的参数
$params = new WechatCloseOrderParameter($config->appid,$config->mch_id,$config->key);
$params->setOutTradeNo('');

//初始化服务提供对象
$client = new WechatPaymentClient($config);
//$client->closeOrder($params);

$json = json_decode('{"name":Null}',true);

var_dump($json['name']);