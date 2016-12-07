<?php
require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../autoload.php';


use Payment\Wechat\Parameters\WechatCloseOrderParameter;
use Payment\Wechat\Parameters\WechatOrderParameter;
use Payment\Wechat\Parameters\WechatQrCodeParameter;
use Payment\Wechat\WechatConfiguration;
use Payment\Wechat\WechatPaymentProvider;


$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');


$provider = new WechatPaymentProvider($config);


$params = new WechatQrCodeParameter($config->appid,$config->mch_id,$config->key);

$params->product_id = 'a88888';

//echo $provider->createQrCode($params);

$params = new WechatOrderParameter($config->appid,$config->mch_id,$config->key);
$params->setBody('测试订单');
$params->setNotifyUrl($config->notify_url);
$params->setOutTradeNo('1151026628743');
$params->total_fee = 1;
$params->trade_type = 'NATIVE';
$params->openid = 'ouAi1jjpoxo2Uy1ZIxUSXW-WLoBI';


$result = $provider->createOrder($params);

//var_dump($result);

$params = new WechatCloseOrderParameter($config->appid,$config->mch_id,$config->key);

$params->out_trade_no = '1151026628743';



$result = $provider->closeOrder($params);

//var_dump($result);

//var_dump(convert_xml_to_array('<xml>
//    <return_code><![CDATA[SUCCESS]]></return_code>
//    <return_msg><![CDATA[OK]]></return_msg>
//    <appid><![CDATA[wx2421b1c4370ec43b]]></appid>
//    <mch_id><![CDATA[10000100]]></mch_id>
//    <nonce_str><![CDATA[IITRi8Iabbblz1Jc]]></nonce_str>
//    <sign><![CDATA[7921E432F65EB8ED0CE9755F0E86D72F]]></sign>
//    <result_code><![CDATA[SUCCESS]]></result_code>
//    <prepay_id><![CDATA[wx201411101639507cbf6ffd8b0779950874]]></prepay_id>
//    <trade_type><![CDATA[JSAPI]]></trade_type>
// </xml> '));