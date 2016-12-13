<?php
date_default_timezone_set('Asia/Shanghai');
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 9:52
 */
require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayWapOrderParameter;
use Payment\Alipay\Parameters\AlipayWapRefundParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$params = new AlipayWapRefundParameter($config->partner);

$params->setSellerUserId($config->get('partner'));
$params->setRefundDate(date('Y-m-d H:i:s'));
$params->setBatchNo(date('Ymdhi').substr(floor(microtime()*1000),0,1).rand(0,9));
$params->setSignType('RSA');
$params->setRsaPrivatePath($config->rsa_private_path);

$params->setDetailData(['trade_no' => '4007572001201607098672633287','total_fee' => 0.01,'reason' => '无理由退款']);

$provider = new AlipayPaymentClient($config);

$result = $provider->refund($params);

var_dump($result);
$date = date('Y-m-d H:i:s');
echo "<a href='{$result}' target='_blank'>支付</a><p>{$date}</p>";

$data = ['a' => 'a'];

$r = isset($data['a']) ?: true;
var_dump($r);
