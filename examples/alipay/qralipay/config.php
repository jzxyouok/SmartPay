<?php
$config = array (
		'alipay_public_key_file' => dirname ( __FILE__ ) . "/key/alipay_public_key.pem",  //支付宝公钥
		'merchant_private_key_file' => dirname ( __FILE__ ) . "/key/rsa_private_key.pem", //商户私钥
		'merchant_public_key_file' => dirname ( __FILE__ ) . "/key/rsa_public_key.pem",   //商户公钥
		'charset' => "utf-8",
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",  //网关地址
		'app_id' => "2015120800935832",   //应用appid  
		'partner' => "2088001385944073",  //商户id  
);