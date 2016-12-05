<?php
require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../autoload.php';

use Payment\PaymentContext;
use Payment\Wechat\WechatConfiguration;



$config = new WechatConfiguration();
$config->initialize(__DIR__ . '/wxconfig.php');

$payment = new PaymentContext($config);




var_dump(convert_xml_to_array('<xml>
    <return_code><![CDATA[SUCCESS]]></return_code>
    <return_msg><![CDATA[OK]]></return_msg>
    <appid><![CDATA[wx2421b1c4370ec43b]]></appid>
    <mch_id><![CDATA[10000100]]></mch_id>
    <nonce_str><![CDATA[IITRi8Iabbblz1Jc]]></nonce_str>
    <sign><![CDATA[7921E432F65EB8ED0CE9755F0E86D72F]]></sign>
    <result_code><![CDATA[SUCCESS]]></result_code>
    <prepay_id><![CDATA[wx201411101639507cbf6ffd8b0779950874]]></prepay_id>
    <trade_type><![CDATA[JSAPI]]></trade_type>
 </xml> '));