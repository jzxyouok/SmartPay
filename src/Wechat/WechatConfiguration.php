<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 11:06
 */

namespace Payment\Wechat;


use Payment\Configuration\PayConfiguration;

/**
 * Class WechatConfiguration
 * @package Payment\Wechat
 * @property string $appid
 * @property string $mch_id
 * @property string $key
 */
class WechatConfiguration extends PayConfiguration
{
    /**
     * @var string 统一下单
     */
    public $unifiedorder_url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    /**
     * @var string 订单查询
     */
    public $orderquery_url = 'https://api.mch.weixin.qq.com/pay/orderquery';
    /**
     * @var string 关闭订单
     */
    public $closeorder_url ='https://api.mch.weixin.qq.com/pay/closeorder';
    /**
     * @var string 申请退款
     */
    public $refund_url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
    /**
     * @var string 退款查询
     */
    public $refundquery_url = 'https://api.mch.weixin.qq.com/pay/refundquery';
    /**
     * @var string 下载对账单
     */
    public $querybill_url ='https://api.mch.weixin.qq.com/pay/downloadbill';
    /**
     * @var string 扫码支付提交订单接口
     */
    public $micropay_url = 'https://api.mch.weixin.qq.com/pay/micropay';
    /**
     * @var string 生成短链接
     */
    public $shorturl_url = 'https://api.mch.weixin.qq.com/tools/shorturl';
    /**
     * @var string 撤销订单
     */
    public $reverse_url = 'https://api.mch.weixin.qq.com/secapi/pay/reverse';
}