<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/9 0009
 * Time: 9:18
 */
require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayTradePaymentProvider;
use Payment\Alipay\Parameters\AlipayWapTransParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayWapTransParameter($config->get('partner'));

//设置业务参数
$parameter->setAccountName($config->get('seller_email'));
$parameter->setDetailData(['serial_no' => uniqid(),'user_account' => 'longfei6671@163.com','user_name' => 'Minho','total_fee'=>'0.01','remark'=>'接口测试']);
$parameter->setBatchNo(uniqid());
$parameter->setBatchFee('0.01');
$parameter->setEmail($config->get('seller_email'));
$parameter->setPayDate(date('Ymd'));
$parameter->setRsaPrivatePath($config->get('rsa_private_path'));

$provider = new AlipayTradePaymentProvider($config);

$result = $provider->handle($parameter);

echo "<a href='{$result}' target='_blank'>支付</a>";