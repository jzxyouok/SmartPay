# SmartPay
PHP实现的微信支付、支付宝支付以及银联支付的SDK。

## 支付宝接口与参数对应表

|接口名称| 参数对象        | 支付宝接口名称           | 文档地址  |
|-------------|:-------------:|:-------------:| -----:|
|批量付款到支付宝账户有密接口| AlipayWapTransParameter     | batch_trans_notify | https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.0tOdsU&treeId=64&articleId=104804&docType=1 |
|即时到账有密退款接口|AlipayWapRefundParameter|refund_fastpay_by_platform_pwd|https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.POEEBV&treeId=60&articleId=104744&docType=1|
|手机网站支付接口参数|AlipayWapOrderParameter|alipay.wap.create.direct.pay.by.user|https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7386797.0.0.rK8ZWl&treeId=60&articleId=104790&docType=1|
|[新版]统一收单交易支付接口(条形码支付)|AlipayTradeParameter|alipay.trade.pay|https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.PlTwKb&apiId=850&docType=4|
|[新版]手机网站支付接口|AlipayTradeWapParameter|alipay.trade.wap.pay|https://doc.open.alipay.com/doc2/detail.htm?treeId=203&articleId=105463&docType=1|





