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
     * 填 32 商品的编号
     *
     * @return string
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * @param string $goods_id
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;
    }

    /**
     * @return string
     */
    public function getWxpayGoodsId()
    {
        return $this->wxpay_goods_id;
    }

    /**
     * @param string $wxpay_goods_id
     */
    public function setWxpayGoodsId($wxpay_goods_id)
    {
        $this->wxpay_goods_id = $wxpay_goods_id;
    }

    /**
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * @param string $goods_name
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getGoodsCategory()
    {
        return $this->goods_category;
    }

    /**
     * @param string $goods_category
     */
    public function setGoodsCategory($goods_category)
    {
        $this->goods_category = $goods_category;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
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