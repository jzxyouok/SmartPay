<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 14:36
 */

require_once __DIR__ . '/../../autoload.php';

use Payment\Alipay\AlipayConfiguration;
use Payment\Alipay\AlipayPaymentClient;
use Payment\Alipay\Parameters\AlipayAuthTokenParameter;
use Payment\Alipay\Parameters\AlipayParameter;

$config = new AlipayConfiguration();
$config->initialize(__DIR__ . '/aliconfig.php');

$parameter = new AlipayParameter();
$parameter->initialize($config);

$params = new AlipayAuthTokenParameter($parameter);

$params->setGrantType('authorization_code');
$params->setCode('c33da4c906684cd4944a2423d650TX48');


$client = new AlipayPaymentClient($config);

$result = $client->handle($params);

echo ($result);

/**
 *
{"alipay_system_oauth_token_response":{"access_token":"composeB59387397016243c2a8170ae58f0baF48","alipay_user_id":"20880017805612230263800391610748","expires_in":500,"re_expires_in":300,"refresh_token":"composeB86e7da69a50646e18c38ea141ad3bC48","user_id":"2088302290682488"},"sign":"im+GFeN9A8yUoDp0SCBL278bJS5BDedZrTl9htOkqFO2TqpjV33m1SSkPf2Vxjq1RIaL208jjgCGxkLiV9CBXTenCMLcN\/mh5h243kevKFGohvDR++Jlx3tpT07eBJOepA1IGedBQMtXPAY2fbY1VRlofVnAtRfEimDyg8BcVdM="}
 */