<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 15:15
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayAuthUserInfoParameter;
use Payment\Alipay\Parameters\AlipayAuthUserParameter;
use Payment\Alipay\Parameters\AlipayParameter;
use Payment\Alipay\Results\AlipayUserInfoResult;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayParameter();
$parameter->initialize($config);

$params = new AlipayAuthUserInfoParameter($parameter);
$params->setAuthToken('composeB802a6e4b9855401282efee691d713X48');

$client = new AlipayPaymentClient($config);

$result = $client->handle($params);

var_dump ($result);
