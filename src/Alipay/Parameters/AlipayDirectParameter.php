<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/9 0009
 * Time: 10:24
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\OrderParameter;
use Payment\Support\Traits\AlipayWapParameterTrait;

/**
 * 即时到账交易接口
 * 该接口是普通商家PC网站支付接口
 *
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.nfrT1f&treeId=108&articleId=104743&docType=1
 *
 * Class AlipayDirectParameter
 * @package Payment\Alipay\Parameters
 *
 *
 */
class AlipayDirectParameter extends OrderParameter
{
    use AlipayWapParameterTrait;

    protected $rsa_private_path = '';
    protected $parameters = array(
        'service' => 'create_direct_pay_by_user',
        '_input_charset'    => 'UTF-8',
        'sign_type'         => 'RSA',
        'partner'           => null,
        'out_trade_no'      => null,
        'subject'           => null,
        'payment_type'      => '1',
        'total_fee'         => null,
        'seller_id'         => null,
        'seller_email'      => null,
        'seller_account_name'   => null,
        'buyer_id'          => null,
        'buyer_email'       => null,
        'buyer_account_name'    => null,
        'price'             => null,
        'quantity'          => null,
        'body'              => null,
        'show_url'          => null,
        'paymethod'         => 'directPay',
        'enable_paymethod'  => null,
        'anti_phishing_key' => null,
        'exter_invoke_ip'   => null,
        'extra_common_param'    => null,
        'it_b_pay'          => '1d',
        'token'             => null,
        'qr_pay_mode'       => null,
        'qrcode_width'      => null,
        'need_buyer_realnamed'  => null,
        'hb_fq_param'       => array(),
        'goods_type'        => '1'
    );

    public function __construct($appid)
    {
        parent::__construct($appid);

    }

    protected function checkDataParams()
    {
        // TODO: Implement checkDataParams() method.
    }

    /**
     * 支付宝合作商户网站唯一订单号。
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 支付宝合作商户网站唯一订单号。
     * @param string $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
        return $this;
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     * 该参数最长为128个汉字。
     * @return string
     */
    public function getSubject()
    {
        return $this->parameters['subject'];
    }

    /**
     * 商品的标题/交易标题/订单标题/订单关键字等。
     * 该参数最长为128个汉字。
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->parameters['subject'] = $subject;
        return $this;
    }

    /**
     * 只支持取值为1（商品购买）。
     * @return string
     */
    public function getPaymentType()
    {
        return $this->parameters['payment_type'];
    }

    /**
     * 只支持取值为1（商品购买）。
     * @param string $payment_type
     * @return $this
     */
    public function setPaymentType($payment_type = '1')
    {
        $this->parameters['payment_type'] = $payment_type;
        return $this;
    }

    /**
     * 该笔订单的资金总额，单位为RMB-Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。
     * @return string
     */
    public function getTotalFee()
    {
        return $this->parameters['total_fee'];
    }

    /**
     * 该笔订单的资金总额，单位为RMB-Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。
     * @param string $total_fee
     * @return $this
     */
    public function setTotalFee($total_fee)
    {
        $this->parameters['total_fee'] = $total_fee;
        return $this;
    }

    /**
     * seller_id是以2088开头的纯16位数字。
     * @return string
     */
    public function getSellerId()
    {
        return $this->parameters['seller_id'];
    }

    /**
     * seller_id是以2088开头的纯16位数字。
     * @param string $seller_id
     * @return $this
     */
    public function setSellerId($seller_id)
    {
        $this->parameters['seller_id'] = $seller_id;
        return $this;
    }

    /**
     * seller_email是支付宝登录账号，格式一般是邮箱或手机号。
     * @return string
     */
    public function getSellerEmail()
    {
        return $this->parameters['seller_email'];
    }

    /**
     * seller_email是支付宝登录账号，格式一般是邮箱或手机号。
     * @param string $seller_email
     * @return $this
     */
    public function setSellerEmail($seller_email)
    {
        $this->parameters['seller_email'] = $seller_email;
        return $this;
    }

    /**
     * seller_account_name是卖家支付宝账号别名。
     * @return string
     */
    public function getSellerAccountName()
    {
        return $this->parameters['seller_account_name'];
    }

    /**
     * seller_account_name是卖家支付宝账号别名。
     * @param string $seller_account_name
     * @return $this
     */
    public function setSellerAccountName($seller_account_name)
    {
        $this->parameters['seller_account_name'] = $seller_account_name;
        return $this;
    }

    /**
     * buyer_id是以2088开头的纯16位数字。
     * @return string
     */
    public function getBuyerId()
    {
        return $this->parameters['buyer_id'];
    }

    /**
     * buyer_id是以2088开头的纯16位数字。
     * @param string $buyer_id
     * @return $this
     */
    public function setBuyerId($buyer_id = null)
    {
        $this->parameters['buyer_id'] = $buyer_id;
        return $this;
    }

    /**
     * buyer_email是支付宝登录账号，格式一般是邮箱或手机号。
     * @return string
     */
    public function getBuyerEmail()
    {
        return $this->parameters['buyer_email'];
    }

    /**
     * buyer_email是支付宝登录账号，格式一般是邮箱或手机号。
     * @param string $buyer_email
     * @return $this
     */
    public function setBuyerEmail($buyer_email = null)
    {
        $this->parameters['buyer_email'] = $buyer_email;
        return $this;
    }

    /**
     * buyer_account_name是买家支付宝账号别名。
     * @return string
     */
    public function getBuyerAccountName()
    {
        return $this->parameters['buyer_account_name'];
    }

    /**
     * buyer_account_name是买家支付宝账号别名。
     * @param string $buyer_account_name
     * @return $this
     */
    public function setBuyerAccountName($buyer_account_name = null)
    {
        $this->parameters['buyer_account_name'] = $buyer_account_name;
        return $this;
    }

    /**
     * 单位为：RMB Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。此参数为单价
     * 规则：price、quantity能代替total_fee。即存在total_fee，就不能存在price和quantity；存在price、quantity，就不能存在total_fee。
     * @return string
     */
    public function getPrice()
    {
        return $this->parameters['price'];
    }

    /**
     * 单位为：RMB Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。此参数为单价
     * 规则：price、quantity能代替total_fee。即存在total_fee，就不能存在price和quantity；存在price、quantity，就不能存在total_fee。
     *
     * @param string $price
     * @return $this
     */
    public function setPrice($price = null)
    {
        $this->parameters['price'] = $price;
        return $this;
    }

    /**
     * 购买数量
     *
     * price、quantity能代替total_fee。即存在total_fee，就不能存在price和quantity；存在price、quantity，就不能存在total_fee。
     * @return string
     */
    public function getQuantity()
    {
        return $this->parameters['quantity'];
    }

    /**
     * 购买数量
     *
     * price、quantity能代替total_fee。即存在total_fee，就不能存在price和quantity；存在price、quantity，就不能存在total_fee。
     *
     * @param string $quantity
     * @return $this
     */
    public function setQuantity($quantity = null)
    {
        $this->parameters['quantity'] = $quantity;
        return $this;
    }

    /**
     * 商品描述
     *
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     *
     * @return string
     */
    public function getBody()
    {
        return $this->parameters['body'];
    }

    /**
     * 商品描述
     *
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     *
     * @param string $body
     * @return $this
     */
    public function setBody($body = null)
    {
        $this->parameters['body'] = $body;
        return $this;
    }

    /**
     * 收银台页面上，商品展示的超链接。
     * @return string
     */
    public function getShowUrl()
    {
        return $this->parameters['show_url'];
    }

    /**
     * 收银台页面上，商品展示的超链接。
     * @param string $show_url
     * @return $this
     */
    public function setShowUrl($show_url = null)
    {
        $this->parameters['show_url'] = $show_url;
        return $this;
    }

    /**
     * 取值范围：
     * creditPay（信用支付）
     * directPay（余额支付）
     * 如果不设置，默认识别为余额支付。
     * 说明：
     * 必须注意区分大小写。
     * @return string
     */
    public function getPaymethod()
    {
        return $this->parameters['paymethod'];
    }

    /**
     * 取值范围：
     * creditPay（信用支付）
     * directPay（余额支付）
     * 如果不设置，默认识别为余额支付。
     * 说明：
     * 必须注意区分大小写。
     *
     * @param string $paymethod
     * @return $this
     */
    public function setPaymethod($paymethod = null)
    {
        $this->parameters['paymethod'] = $paymethod;
        return $this;
    }

    /**
     * 用于控制收银台支付渠道显示，该值的取值范围请参见支付渠道。
     * 可支持多种支付渠道显示，以“^”分隔。
     *
     * @return string
     */
    public function getEnablePaymethod()
    {
        return $this->parameters['enable_paymethod'];
    }

    /**
     * 用于控制收银台支付渠道显示，该值的取值范围请参见支付渠道。
     * 可支持多种支付渠道显示，以“^”分隔。
     *
     * @param string $enable_paymethod
     * @return $this
     */
    public function setEnablePaymethod($enable_paymethod = null)
    {
        $this->parameters['enable_paymethod'] = $enable_paymethod;
        return $this;
    }

    /**
     * 通过时间戳查询接口获取的加密支付宝系统时间戳。
     * 如果已申请开通防钓鱼时间戳验证，则此字段必填。
     *
     * @return string
     */
    public function getAntiPhishingKey()
    {
        return $this->parameters['anti_phishing_key'];
    }

    /**
     * 通过时间戳查询接口获取的加密支付宝系统时间戳。
     * 如果已申请开通防钓鱼时间戳验证，则此字段必填。
     *
     * @param string $anti_phishing_key
     * @return $this
     */
    public function setAntiPhishingKey($anti_phishing_key = null)
    {
        $this->parameters['anti_phishing_key'] = $anti_phishing_key;
        return $this;
    }

    /**
     * 用户在创建交易时，该用户当前所使用机器的IP。
     * 如果商户申请后台开通防钓鱼IP地址检查选项，此字段必填，校验用。
     *
     * @return string
     */
    public function getExterInvokeIp()
    {
        return $this->parameters['exter_invoke_ip'];
    }

    /**
     * 用户在创建交易时，该用户当前所使用机器的IP。
     * 如果商户申请后台开通防钓鱼IP地址检查选项，此字段必填，校验用。
     *
     * @param string $exter_invoke_ip
     * @return $this
     */
    public function setExterInvokeIp($exter_invoke_ip = null)
    {
        $this->parameters['exter_invoke_ip'] = $exter_invoke_ip;
        return $this;
    }

    /**
     * 如果用户请求时传递了该参数，则返回给商户时会回传该参数。
     *
     * @return string
     */
    public function getExtraCommonParam()
    {
        return $this->parameters['extra_common_param'];
    }

    /**
     * 如果用户请求时传递了该参数，则返回给商户时会回传该参数。
     *
     * @param string $extra_common_param
     *
     * @return $this
     */
    public function setExtraCommonParam($extra_common_param = null)
    {
        $this->parameters['extra_common_param'] = $extra_common_param;
        return $this;
    }

    /**
     * 设置未付款交易的超时时间，一旦超时，该笔交易就会自动被关闭。
     * 取值范围：1m～15d。
     * m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点，如1.5h，可转换为90m。
     *
     * @return string
     */
    public function getItBPay()
    {
        return $this->parameters['it_b_pay'];
    }

    /**
     * 设置未付款交易的超时时间，一旦超时，该笔交易就会自动被关闭。
     * 取值范围：1m～15d。
     * m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点，如1.5h，可转换为90m。
     *
     * @param string $it_b_pay
     * @return $this
     */
    public function setItBPay($it_b_pay = '1d')
    {
        $this->parameters['it_b_pay'] = $it_b_pay;
        return $this;
    }

    /**
     * 如果开通了快捷登录产品，则需要填写；如果没有开通，则为空。
     *
     * @return string
     */
    public function getToken()
    {
        return $this->parameters['token'];
    }

    /**
     * 如果开通了快捷登录产品，则需要填写；如果没有开通，则为空。
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token = null)
    {
        $this->parameters['token'] = $token;
        return $this;
    }

    /**
     * 扫码支付的方式，支持前置模式和跳转模式。
     *
     * 前置模式是将二维码前置到商户的订单确认页的模式。需要商户在自己的页面中以iframe方式请求支付宝页面。具体分为以下4种：
     * 0：订单码-简约前置模式，对应iframe宽度不能小于600px，高度不能小于300px；
     * 1：订单码-前置模式，对应iframe宽度不能小于300px，高度不能小于600px；
     * 3：订单码-迷你前置模式，对应iframe宽度不能小于75px，高度不能小于75px。
     * 4：订单码-可定义宽度的嵌入式二维码，商户可根据需要设定二维码的大小。
     * 跳转模式下，用户的扫码界面是由支付宝生成的，不在商户的域名下。
     * 2：订单码-跳转模式
     *
     * @return string
     */
    public function getQrPayMode()
    {
        return $this->parameters['qr_pay_mode'];
    }

    /**
     * 扫码支付的方式，支持前置模式和跳转模式。
     *
     * 前置模式是将二维码前置到商户的订单确认页的模式。需要商户在自己的页面中以iframe方式请求支付宝页面。具体分为以下4种：
     * 0：订单码-简约前置模式，对应iframe宽度不能小于600px，高度不能小于300px；
     * 1：订单码-前置模式，对应iframe宽度不能小于300px，高度不能小于600px；
     * 3：订单码-迷你前置模式，对应iframe宽度不能小于75px，高度不能小于75px。
     * 4：订单码-可定义宽度的嵌入式二维码，商户可根据需要设定二维码的大小。
     * 跳转模式下，用户的扫码界面是由支付宝生成的，不在商户的域名下。
     * 2：订单码-跳转模式
     *
     * @param string $qr_pay_mode
     * @return $this
     */
    public function setQrPayMode($qr_pay_mode = null)
    {
        $this->parameters['qr_pay_mode'] = $qr_pay_mode;
        return $this;
    }

    /**
     * 商户自定义的二维码宽度。
     * 当qr_pay_mode=4时，该参数生效。
     *
     * @return string
     */
    public function getQrcodeWidth()
    {
        return $this->parameters['qrcode_width'];
    }

    /**
     * 商户自定义的二维码宽度。
     * 当qr_pay_mode=4时，该参数生效。
     *
     * @param string $qrcode_width
     * @return $this
     */
    public function setQrcodeWidth($qrcode_width = null)
    {
        $this->parameters['qrcode_width'] = $qrcode_width;
        return $this;
    }

    /**
     * 是否需要买家实名认证。
     * T表示需要买家实名认证；
     * 不传或者传其它值表示不需要买家实名认证。
     *
     * @return string
     */
    public function getNeedBuyerRealnamed()
    {
        return $this->parameters['need_buyer_realnamed'];
    }

    /**
     * 是否需要买家实名认证。
     * T表示需要买家实名认证；
     * 不传或者传其它值表示不需要买家实名认证。
     *
     * @param string $need_buyer_realnamed
     * @return $this
     */
    public function setNeedBuyerRealnamed($need_buyer_realnamed = null)
    {
        $this->parameters['need_buyer_realnamed'] = $need_buyer_realnamed;
        return $this;
    }

    /**
     * 花呗分期参数
     *
     * 参数格式：hb_fq_seller_percent ^卖家承担付费比例|hb_fq_num ^期数。
     * hb_fq_num：花呗分期数，比如分3期支付；
     * hb_fq_seller_percent：卖家承担收费比例，比如100代表卖家承担100%。
     * 两个参数必须一起传入。
     * 两个参数用“|”间隔。Key和value之间用“^”间隔。
     * 具体花呗分期期数和卖家承担收费比例可传入的数值请咨询支付宝。
     *
     * @return array
     */
    public function getHbFqParam()
    {
        return $this->parameters['hb_fq_param'];
    }

    /**
     * 花呗分期参数
     *
     * @param int $hb_fq_num 花呗分期数，比如分3期支付；
     * @param string $hb_fq_seller_percent 卖家承担收费比例，比如100代表卖家承担100%。
     * @return $this
     */
    public function setHbFqParam($hb_fq_num, $hb_fq_seller_percent)
    {
        $this->parameters['hb_fq_param']['hb_fq_num'] = $hb_fq_num;
        $this->parameters['hb_fq_param']['hb_fq_seller_percent'] = $hb_fq_seller_percent;
        return $this;
    }

    /**
     * 商品类型：
     * 1表示实物类商品
     * 0表示虚拟类商品
     * 如果不传，默认为实物类商品。
     *
     * @return string
     */
    public function getGoodsType()
    {
        return $this->parameters['goods_type'];
    }

    /**
     * 商品类型：
     * 1表示实物类商品
     * 0表示虚拟类商品
     * 如果不传，默认为实物类商品。
     *
     * @param string $goods_type
     * @return $this
     */
    public function setGoodsType($goods_type = '1')
    {
        $this->parameters['goods_type'] = $goods_type;
        return $this;
    }


}