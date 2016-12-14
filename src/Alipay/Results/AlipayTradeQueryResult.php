<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 16:33
 */

namespace Payment\Alipay\Results;


use Payment\AbstractResult;

/**
 * 统一收单线下交易查询结果
 *
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=757&docType=4
 *
 * @package Payment\Alipay\Results
 *
 */
class AlipayTradeQueryResult extends AlipayTradeResult
{

    /**
     * 支付宝交易号
     *
     * @return string
     */
    public function getTradeNo()
    {
        return array_value('trade_no',$this->response['alipay_trade_query_response']);
    }

    /**
     * 商家订单号
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->response['alipay_trade_query_response']);
    }

    /**
     * 买家支付宝账号
     * @return string
     */
    public function getBuyerLogonId()
    {
        return array_value('buyer_logon_id',$this->response['alipay_trade_query_response']);
    }

    /**
     * 交易状态：
     * WAIT_BUYER_PAY（交易创建，等待买家付款）、
     * TRADE_CLOSED（未付款交易超时关闭，或支付完成后全额退款）、
     * TRADE_SUCCESS（交易支付成功）、
     * TRADE_FINISHED（交易结束，不可退款）
     *
     * @return string
     */
    public function getTradeStatus()
    {
        return array_value('trade_status',$this->response['alipay_trade_query_response']);
    }

    /**
     * 交易的订单金额，单位为元，两位小数。
     * @return string
     */
    public function getTotalAmount()
    {
        return array_value('total_amount',$this->response['alipay_trade_query_response']);
    }

    /**
     * 实收金额，单位为元，两位小数。
     * @return string
     */
    public function getReceiptAmount()
    {
        return array_value('receipt_amount',$this->response['alipay_trade_query_response']);
    }

    /**
     * 买家实付金额，单位为元，两位小数。
     * @return string
     */
    public function getBuyerPayAmount()
    {
        return array_value('buyer_pay_amount',$this->response['alipay_trade_query_response']);
    }

    /**
     * 积分支付的金额，单位为元，两位小数。
     * @return string
     */
    public function getPointAmount()
    {
        return array_value('point_amount',$this->response['alipay_trade_query_response']);
    }

    /**
     * 交易中用户支付的可开具发票的金额，单位为元，两位小数。
     * @return string
     */
    public function getInvoiceAmount()
    {
        return array_value('invoice_amount',$this->response['alipay_trade_query_response']);
    }

    /**
     * 本次交易打款给卖家的时间
     * @return string
     */
    public function getSendPayDate()
    {
        return array_value('send_pay_date',$this->response['alipay_trade_query_response']);
    }

    /**
     * 支付宝店铺编号
     * @return string
     */
    public function getAlipayStoreId()
    {
        return array_value('alipay_store_id',$this->response['alipay_trade_query_response']);
    }

    /**
     * 	商户门店编号
     * @return string
     */
    public function getStoreId()
    {
        return array_value('store_id',$this->response['alipay_trade_query_response']);
    }

    /**
     * 	商户机具终端编号
     * @return string
     */
    public function getTerminalId()
    {
        return array_value('terminal_id',$this->response['alipay_trade_query_response']);
    }

    /**
     * 	交易支付使用的资金渠道
     * @return array
     */
    public function getFundBillList()
    {
        return isset($this->response['alipay_trade_query_response']['fund_bill_list'])?$this->response['alipay_trade_query_response']['fund_bill_list']:null;
    }

    /**
     * 请求交易支付中的商户店铺的名称
     * @return string
     */
    public function getStoreName()
    {
        return isset($this->response['alipay_trade_query_response']['store_name'])?$this->response['alipay_trade_query_response']['store_name']:null;
    }

    /**
     * 	买家在支付宝的用户id
     * @return string
     */
    public function getBuyerUserId()
    {
        return isset($this->response['alipay_trade_query_response']['buyer_user_id'])?$this->response['alipay_trade_query_response']['buyer_user_id']:null;
    }

    /**
     * 本次交易支付所使用的单品券优惠的商品优惠信息
     * @return array
     */
    public function getDiscountGoodsDetail()
    {
        return isset($this->response['alipay_trade_query_response']['discount_goods_detail'])? json_decode($this->response['alipay_trade_query_response']['discount_goods_detail']):null;
    }

    /**
     * 行业特殊信息（例如在医保卡支付业务中，向用户返回医疗信息）
     * @return array
     */
    public function getIndustrySepcDetail()
    {
        return isset($this->response['alipay_trade_query_response']['industry_sepc_detail'])?json_decode($this->response['alipay_trade_query_response']['industry_sepc_detail']):null;
    }



}