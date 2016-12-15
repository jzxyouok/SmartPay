# SmartPay
PHP实现的微信支付、支付宝支付以及银联支付的SDK。

## 支付宝接口与参数对应表

|接口说明| 参数对象        | 支付宝接口名称   | 文档地址  |
|-----------|:-----------|:-----------|:--------|
|批量付款到支付宝账户有密接口| AlipayWapTransParameter     | batch_trans_notify | [支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.0tOdsU&treeId=64&articleId=104804&docType=1)|
|即时到账有密退款接口|AlipayWapRefundParameter|refund_fastpay_by_platform_pwd|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.POEEBV&treeId=60&articleId=104744&docType=1)|
|手机网站支付接口参数|AlipayWapOrderParameter|alipay.wap.create.direct.pay.by.user|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7386797.0.0.rK8ZWl&treeId=60&articleId=104790&docType=1)|
|【新版】统一收单交易支付接口(条形码支付)|AlipayTradeParameter|alipay.trade.pay|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.PlTwKb&apiId=850&docType=4)|
|【新版】手机网站支付接口|AlipayTradeWapParameter|alipay.trade.wap.pay|[支付宝文档](https://doc.open.alipay.com/doc2/detail.htm?treeId=203&articleId=105463&docType=1)|
|【新版】统一收单线下交易查询|AlipayTradeQueryParameter|alipay.trade.query|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=757&docType=4)|
|【新版】统一收单交易关闭接口|AlipayTradeCloseParameter|alipay.trade.close|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=1058&docType=4)|
|【新版】查询对账单下载地址|AlipayTradeBillParameter|alipay.data.dataservice.bill.downloadurl.query|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=1054&docType=4)|
|统一收单交易撤销接口|AlipayTradeCancelParameter|alipay.trade.cancel|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.PlTwKb&apiId=866&docType=4)|
|统一收单线下交易预创建|AlipayTradeQrCodeParameter|alipay.trade.precreate|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.PlTwKb&apiId=862&docType=4)|
|统一收单交易退款接口|AlipayTradeRefundParameter|alipay.trade.refund| [支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=759&docType=4)|
|统一收单交易退款查询|AlipayTradeRefundQueryParameter|alipay.trade.fastpay.refund.query|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?docType=4&apiId=1049)|
|统一收单交易结算接口|AlipayTradeSettleParameter|alipay.trade.order.settle|[支付宝文档](https://doc.open.alipay.com/docs/api.htm?spm=a219a.7395905.0.0.CVWgAP&docType=4&apiId=1147)|
|支付宝钱包用户信息共享|AlipayAuthUserInfoParameter|alipay.user.userinfo.share|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.dmVpXA&apiId=876&docType=4)|
|支付宝会员授权信息查询接口|AlipayAuthUserParameter|alipay.user.info.share|[支付宝文档](https://doc.open.alipay.com/docs/api.htm?spm=a219a.7395905.0.0.y1UOT0&docType=4&apiId=1218)|
|App用户登录换取授权访问令牌|AlipayAuthTokenParameter|alipay.system.oauth.token|[支付宝文档](https://doc.open.alipay.com/doc2/apiDetail.htm?spm=a219a.7629065.0.0.k4e1Tr&apiId=1025&docType=4)|



## 支付宝回调通知对象说明

|接口说明       | 参数对象       | 对应接口名称  | 文档地址    |
|-------------|:-------------|:----------|:----------|
|【旧版】支付回调接口|AlipayWapOrderNotify|alipay.wap.create.direct.pay.by.user|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.i5A1qh&treeId=60&articleId=104790&docType=1)|
|【旧版】手机支付退款通知结果|AlipayWapRefundNotify|refund_fastpay_by_platform_pwd|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.GhyLH2&treeId=60&articleId=104744&docType=1#s4)|
|【旧版】即时到账交易接口|AlipayDirectNotify|create_direct_pay_by_user|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.nfrT1f&treeId=108&articleId=104743&docType=1#s2)|
|【新版】支付回调接口|AlipayTradeOrderNotify|alipay.trade.wap.pay,alipay.trade.pay|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.pca64f&treeId=193&articleId=105301&docType=1)|
|【新版】扫码支付回调|AlipayTradeQrCodeNotity|alipay.trade.precreate|[支付宝文档](https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.nK1gxL&treeId=193&articleId=103296&docType=1)|




