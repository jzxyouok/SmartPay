<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/7 0007
 * Time: 10:41
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Wechat\Parameters\WechatQrCodeParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentClient;

//初始化配置信息
$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');

$params = new WechatQrCodeParameter($config->appid,$config->mch_id,$config->key);

$params->setProductId('aaa');

$client= new WechatPaymentClient($config);

$result = $client->handle($params);

var_dump($result);