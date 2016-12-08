<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/7 0007
 * Time: 16:59
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\OrderParameter;
use Payment\Support\Traits\AlipayWapParameterTrait;

/**
 * 手机网站支付接口参数，适用于WAP、Android、IOS等网页支付
 *
 * 要使用手机网站支付接口的权限，需要先签约手机网站支付产品。
 * 申请地址：@link https://b.alipay.com/order/productDetail.htm?productId=2015110218008816
 * 接口文档： @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7386797.0.0.rK8ZWl&treeId=60&articleId=104790&docType=1
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayWapOrderParameter extends OrderParameter
{
    use AlipayWapParameterTrait;

    protected $rsa_private_path = '';

    protected $parameters = array(
        'service' => 'alipay.wap.create.direct.pay.by.user',
        '_input_charset'    => 'UTF-8',
        'sign_type'         => 'MD5',

    );

    /**
     * AlipayWapOrderParameter constructor.
     * @param string $partner 签约的支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。
     */
    public function __construct($partner)
    {
        $this->parameters['partner'] = $partner;
        $this->parameters['payment_type'] = '1';
        $this->parameters['goods_type'] = '1';
        $this->setItBPay('1d');

        parent::__construct($partner);
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
     * 该笔订单的资金总额，单位为RMB-Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。
     * @return float
     */
    public function getTotalFee()
    {
        return $this->parameters['total_fee'];
    }

    /**
     * 该笔订单的资金总额，单位为RMB-Yuan。取值范围为[0.01，100000000.00]，精确到小数点后两位。
     * @param float $total_fee
     * @return $this
     */
    public function setTotalFee($total_fee)
    {
        $this->parameters['total_fee'] = $total_fee;
        return $this;
    }

    /**
     * 卖家支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字
     * @return string
     */
    public function getSellerId()
    {
        return $this->parameters['seller_id'];
    }

    /**
     * 卖家支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字
     * @param string $seller_id
     * @return $this
     */
    public function setSellerId($seller_id)
    {
        $this->parameters['seller_id'] = $seller_id;
        return $this;
    }

    /**
     * 支付类型。仅支持：1（商品购买）。
     * @return string
     */
    public function getPaymentType()
    {
        return $this->parameters['payment_type'];
    }

    /**
     * 支付类型。仅支持：1（商品购买）。
     * @param string $payment_type
     * @return $this
     */
    public function setPaymentType($payment_type = '1')
    {
        $this->parameters['payment_type'] = $payment_type;
        return $this;
    }

    /**
     * 用户付款中途退出返回商户网站的地址。
     * @return string
     */
    public function getShowUrl()
    {
        return $this->parameters['show_url'];
    }

    /**
     * 用户付款中途退出返回商户网站的地址。
     * @param string $show_url
     * @return $this
     */
    public function setShowUrl($show_url)
    {
        $this->parameters['show_url'] = $show_url;
        return $this;
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     * @return string
     */
    public function getBody()
    {
        return $this->parameters['body'];
    }

    /**
     * 对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。
     * @param string $body
     * @return $this
     */
    public function setBody($body = null)
    {
        $this->parameters['body'] = $body;
        return $this;
    }

    /**
     * 设置未付款交易的超时时间，一旦超时，该笔交易就会自动被关闭。
     * 取值范围：1m～15d。
     * m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。
     * 该参数数值不接受小数点，如1.5h，可转换为90m。
     * 当用户输入支付密码、点击确认付款后（即创建支付宝交易后）开始计时。
     * 支持绝对超时时间，格式为yyyy-MM-dd HH:mm。
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
     * 当用户输入支付密码、点击确认付款后（即创建支付宝交易后）开始计时。
     * 支持绝对超时时间，格式为yyyy-MM-dd HH:mm。
     * @param string $it_b_pay
     * @return $this
     */
    public function setItBPay($it_b_pay = '1d')
    {
        $this->parameters['it_b_pay'] = $it_b_pay;
        return $this;
    }

    /**
     * 接入极简版wap收银台时支持。
     * 当商户请求是来自支付宝钱包，在支付宝钱包登录后，有生成登录信息token时，使用该参数传入token将可以实现信任登录收银台，不需要再次登录。
     * 注意：
     * 登录后用户还是有入口可以切换账户，不能使用该参数锁定用户。
     * @return string
     */
    public function getExternToken()
    {
        return $this->parameters['extern_token'];
    }

    /**
     * 接入极简版wap收银台时支持。
     * 当商户请求是来自支付宝钱包，在支付宝钱包登录后，有生成登录信息token时，使用该参数传入token将可以实现信任登录收银台，不需要再次登录。
     * 注意：
     * 登录后用户还是有入口可以切换账户，不能使用该参数锁定用户。
     * @param string $extern_token
     * @return $this
     */
    public function setExternToken($extern_token = null)
    {
        $this->parameters['extern_token'] = $extern_token;
        return $this;
    }

    /**
     * 航旅订单中除去票面价之外的费用，单位为RMB-Yuan。取值范围为[0.01,100000000.00]，精确到小数点后两位。
     * @return float
     */
    public function getOtherfee()
    {
        return $this->parameters['otherfee'];
    }

    /**
     * 航旅订单中除去票面价之外的费用，单位为RMB-Yuan。取值范围为[0.01,100000000.00]，精确到小数点后两位。
     * @param float $otherfee
     * @return $this
     */
    public function setOtherfee($otherfee = null)
    {
        $this->parameters['otherfee'] = $otherfee;
        return $this;
    }

    /**
     * 航旅订单金额描述，由四项或两项构成，各项之间由“|”分隔，每项包含金额与描述，金额与描述间用“^”分隔，票面价之外的价格之和必须与otherfee相等。
     * @return string
     */
    public function getAirticket()
    {
        return $this->parameters['airticket'];
    }

    /**
     * 航旅订单金额描述，由四项或两项构成，各项之间由“|”分隔，每项包含金额与描述，金额与描述间用“^”分隔，票面价之外的价格之和必须与otherfee相等。
     * @param string $airticket
     * @return $this
     */
    public function setAirticket($airticket = null)
    {
        $this->parameters['airticket'] = $airticket;
        return $this;
    }

    /**
     * 是否发起实名校验
     * T：发起实名校验；
     * F：不发起实名校验
     * @return string
     */
    public function getRnCheck()
    {
        return $this->parameters['rn_check'];
    }

    /**
     * 是否发起实名校验
     * T：发起实名校验；
     * F：不发起实名校验
     * @param string $rn_check
     * @return $this
     */
    public function setRnCheck($rn_check = 'F')
    {
        $this->parameters['rn_check'] = $rn_check;
        return $this;
    }

    /**
     * 买家证件号码（需要与支付宝实名认证时所填写的证件号码一致）。
     * 说明：
     * 当scene=ZJCZTJF的情况下，才会校验buyer_cert_no字段。
     *
     * @return string
     */
    public function getBuyerCertNo()
    {
        return $this->parameters['buyer_cert_no'];
    }

    /**
     * 买家证件号码（需要与支付宝实名认证时所填写的证件号码一致）。
     * 说明：
     * 当scene=ZJCZTJF的情况下，才会校验buyer_cert_no字段。
     * @param string $buyer_cert_no
     * @return $this
     */
    public function setBuyerCertNo($buyer_cert_no = null)
    {
        $this->parameters['buyer_cert_no'] = $buyer_cert_no;
        return $this;
    }

    /**
     * 买家真实姓名。
     * 说明：
     * 当scene=ZJCZTJF的情况下，才会校验buyer_real_name字段。
     *
     * @return string
     */
    public function getBuyerRealName()
    {
        return $this->parameters['buyer_real_name'];
    }

    /**
     * 买家真实姓名。
     * 说明：
     * 当scene=ZJCZTJF的情况下，才会校验buyer_real_name字段。
     * @param string $buyer_real_name
     * @return $this
     */
    public function setBuyerRealName($buyer_real_name = null)
    {
        $this->parameters['buyer_real_name'] = $buyer_real_name;
        return $this;
    }

    /**
     * 收单场景。如需使用该字段，需向支付宝申请开通，否则传入无效。
     * @return string
     */
    public function getScene()
    {
        return $this->parameters['scene'];
    }

    /**
     * 收单场景。如需使用该字段，需向支付宝申请开通，否则传入无效。
     * @param string $scene
     * @return $this
     */
    public function setScene($scene = null)
    {
        $this->parameters['scene'] = $scene;
        return $this;
    }

    /**
     * 花呗分期参数
     * Json格式。
     * hb_fq_num：花呗分期数，比如分3期支付；
     * hb_fq_seller_percent：卖家承担收费比例，比如100代表卖家承担100%。
     * 两个参数必须一起传入。
     * 具体花呗分期期数和卖家承担收费比例可传入的数值请咨询支付宝。
     * @return string
     */
    public function getHbFqParam()
    {
        return $this->parameters['hb_fq_param'];
    }

    /**
     * 花呗分期参数
     * Json格式。
     * hb_fq_num：花呗分期数，比如分3期支付；
     * hb_fq_seller_percent：卖家承担收费比例，比如100代表卖家承担100%。
     * 两个参数必须一起传入。
     * 具体花呗分期期数和卖家承担收费比例可传入的数值请咨询支付宝。
     *
     * @param string $hb_fq_param
     * @return $this
     */
    public function setHbFqParam($hb_fq_param = null)
    {
        $this->parameters['hb_fq_param'] = $hb_fq_param;
        return $this;
    }

    /**
     * 商品类型。
     * 1：实物类商品
     * 0：虚拟类商品
     * 不传默认为实物类商品。
     * @return string
     */
    public function getGoodsType()
    {
        return $this->parameters['goods_type'];
    }

    /**
     * 商品类型。
     * 1：实物类商品
     * 0：虚拟类商品
     * 不传默认为实物类商品。
     * @param string $goods_type
     * @return $this
     */
    public function setGoodsType($goods_type = '1')
    {
        $this->parameters['goods_type'] = $goods_type;
        return $this;
    }

    /**
     * 是否使用支付宝客户端支付
     * app_pay=Y：尝试唤起支付宝客户端进行支付，若用户未安装支付宝，则继续使用wap收银台进行支付。商户若为APP，则需在APP的webview中增加alipays协议处理逻辑。
     *
     * @return string
     */
    public function getAppPay()
    {
        return $this->parameters['app_pay'];
    }

    /**
     * 是否使用支付宝客户端支付
     * app_pay=Y：尝试唤起支付宝客户端进行支付，若用户未安装支付宝，则继续使用wap收银台进行支付。商户若为APP，则需在APP的webview中增加alipays协议处理逻辑。
     *
     * @param string $app_pay
     * @return $this
     */
    public function setAppPay($app_pay = null)
    {
        $this->parameters['app_pay'] = $app_pay;
        return $this;
    }

    /**
     * 商户与支付宝约定的营销参数，为Key:Value键值对，如需使用，请联系支付宝技术人员。
     * @return string
     */
    public function getPromoParams()
    {
        return $this->parameters['promo_params'];
    }

    /**
     * 商户与支付宝约定的营销参数，为Key:Value键值对，如需使用，请联系支付宝技术人员。
     * @param string $promo_params
     * @return $this
     */
    public function setPromoParams($promo_params = null)
    {
        $this->parameters['promo_params'] = $promo_params;
        return $this;
    }

    /**
     * 可用渠道，用户只能在指定渠道范围内支付。
     * 当有多个渠道时，用“,”分隔。
     * @return string
     */
    public function getEnablePaymethod()
    {
        return $this->parameters['enable_paymethod'];
    }

    /**
     * 可用渠道，用户只能在指定渠道范围内支付。
     * 当有多个渠道时，用“,”分隔。
     * @param string $enable_paymethod
     * @return $this
     */
    public function setEnablePaymethod($enable_paymethod = null)
    {
        $this->parameters['enable_paymethod'] = $enable_paymethod;
        return $this;
    }

    /**
     * 检查参数的完整性
     * @throws PaymentException
     */
    protected function checkDataParams()
    {
        if(!isset($this->parameters['partner']) || $this->parameters['partner'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 partner');
        }
        if($this->getSignType() == 'MD5' && (!isset($this->parameters['key']) || $this->parameters['key'] === null)){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 key');
        }
        if(!isset($this->parameters['out_trade_no']) || $this->parameters['out_trade_no'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 out_trade_no');
        }
        if(!isset($this->parameters['subject']) || $this->parameters['subject'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 subject');
        }
        if(!isset($this->parameters['total_fee']) || $this->parameters['total_fee'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 total_fee');
        }
        if(!isset($this->parameters['seller_id']) || $this->parameters['seller_id'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 seller_id');
        }
        if(!isset($this->parameters['payment_type']) || $this->parameters['payment_type'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 payment_type');
        }
        if(!isset($this->parameters['show_url']) || $this->parameters['show_url'] === null){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 show_url');
        }

    }

}