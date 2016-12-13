<?php

/**
 * 普通支付不手机支付，批量退款，批量支付等配置文件
 */
return [
    'appid' => '2015120800935832',      //应用APPId，该值为支付宝后台创建的应用
    'partner' => '2088001385944073',    //商户ID
    'notify_url' => 'https://pay.minho.com',    //支付宝异步通知地址
    'charset' => 'utf-8',                       //编码格式
    'rsa_private_path' => __DIR__ . '/wap/rsa_private_key.pem',  //RSA加密的私钥
    'rsa_public_path' => __DIR__ . '/wap/alipay_public_key.pem',    //支付宝公钥
    'open_rsa_private_path' => __DIR__ . '/qralipay/key/rsa_private_key.pem',   //蚂蚁金服开发接口私钥
    'open_rsa_public_path'  => __DIR__ . '/qralipay/key/rsa_public_key.pem',    //蚂蚁金服开放接口公钥
    'open_alipay_url'        => 'https://openapi.alipay.com/gateway.do', //蚂蚁金服开放平台网关
    'wap_alipay_url'    => 'https://mapi.alipay.com/gateway.do',  //支付宝手机网页支付网关
    'seller_email' => 'baiyjk@baiyyy.com.cn', //卖家的支付宝账号
    'sslcert'       => [                    //HTTPS证书
        'sslcert_path' => __DIR__ . '/wap/cacert.pem',
    ],
];