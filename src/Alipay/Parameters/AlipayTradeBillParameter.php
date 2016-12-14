<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 10:26
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\BillParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 查询对账单下载地址
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=1054&docType=4
 *
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayTradeBillParameter extends BillParameter
{
    protected $method = 'alipay.data.dataservice.bill.downloadurl.query';
    use AlipayParameterTrait;
    protected $parameters = [
        'bill_type' => null,
        'bill_date' => null
    ];

    protected function checkDataParams()
    {
        if(empty($this->parameters['bill_type'])){
            throw new PaymentException('账单类型不能为空： bill_type');
        }
        if(empty($this->parameters['bill_date'])){
            throw new PaymentException('账单时间不能为空： bill_date');
        }
    }

    /**
     * 账单类型，商户通过接口或商户经开放平台授权后其所属服务商通过接口可以获取以下账单类型：trade、signcustomer；
     * trade指商户基于支付宝交易收单的业务账单；
     * signcustomer是指基于商户支付宝余额收入及支出等资金变动的帐务账单；
     *
     * @return string
     */
    public function getBillType()
    {
        return $this->parameters['bill_type'];
    }

    /**
     * 账单类型，商户通过接口或商户经开放平台授权后其所属服务商通过接口可以获取以下账单类型：trade、signcustomer；
     * trade指商户基于支付宝交易收单的业务账单；
     * signcustomer是指基于商户支付宝余额收入及支出等资金变动的帐务账单；
     *
     * @param string $bill_type
     * @return  $this
     */
    public function setBillType($bill_type)
    {
        $this->parameters['bill_type'] = $bill_type;
        return $this;
    }

    /**
     * 账单时间：日账单格式为yyyy-MM-dd，月账单格式为yyyy-MM。
     *
     * @return string
     */
    public function getBillDate()
    {
        return $this->parameters['bill_date'];
    }

    /**
     * 账单时间：日账单格式为yyyy-MM-dd，月账单格式为yyyy-MM。
     *
     * @param string $bill_date
     * @return  $this
     */
    public function setBillDate($bill_date)
    {
        $this->parameters['bill_date'] = $bill_date;
        return $this;
    }

}