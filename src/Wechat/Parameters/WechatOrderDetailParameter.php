<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 15:30
 */

namespace Payment\Wechat\Parameters;

/**
 * 商品详情参数
 * Class WechatOrderDetailParameter
 * @package Payment\Wechat\Parameters
 */
class WechatOrderDetailParameter
{
    /**
     * @var string 必填 32 商品的编号
     */
    public $goods_id;
    /**
     * @var string 可选 32 微信支付定义的统一商品编号
     */
    public $wxpay_goods_id;
    /**
     * @var string 必填 256 商品名称
     */
    public $goods_name ;
    /**
     * @var int 必填 商品数量
     */
    public $quantity;
    /**
     * @var int 必填 商品单价，单位为分
     */
    public $price ;
    /**
     * @var string 可选 32 商品类目ID
     */
    public $goods_category;
    /**
     * @var string 可选 1000 商品描述信息
     */
    public $body ;
}