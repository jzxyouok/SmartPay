<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/13 0013
 * Time: 17:51
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\CloseOrderParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单交易关闭接口
 * @link https://doc.open.alipay.com/doc2/apiDetail.htm?apiId=1058&docType=4
 *
 */
class AlipayTradeCloseParameter extends CloseOrderParameter
{
    protected $method = 'alipay.trade.close';
    protected $parameters = [
        'out_trade_no'  => null,
        'trade_no'      => null,
        'operator_id'   => null
    ];

    use AlipayParameterTrait;

    protected function buildData()
    {
        $this->parameter->checkParams();

        $data = $this->parameter->getData();

        $params = [];

        foreach ($this->parameters as $key=>$value){
            if(empty($value)===false){
                $params[$key] = $value;
            }
        }

        $data['biz_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        $this->requestData = $data;
    }

    protected function checkDataParams()
    {
        if(empty($this->parameters['out_trade_no']) && empty($this->parameters['trade_no'])){
            throw new PaymentException('out_trade_no 和 trade_no 不能同时为空');
        }
    }

    /**
     * 	该交易在支付宝系统中的交易流水号。最短 16 位，最长 64 位。和out_trade_no不能同时为空，如果同时传了 out_trade_no和 trade_no，则以 trade_no为准
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->parameters['trade_no'];
    }

    /**
     * 	该交易在支付宝系统中的交易流水号。最短 16 位，最长 64 位。和out_trade_no不能同时为空，如果同时传了 out_trade_no和 trade_no，则以 trade_no为准
     *
     * @param string $trade_no
     * @return $this
     */
    public function setTradeNo($trade_no)
    {
        $this->parameters['trade_no'] = $trade_no;
        return $this;
    }

    /**
     * 订单支付时传入的商户订单号,和支付宝交易号不能同时为空。 trade_no,out_trade_no如果同时存在优先取trade_no
     *
     * @return string
     */
    public function getOutTradeNo()
    {
        return $this->parameters['out_trade_no'];
    }

    /**
     * 订单支付时传入的商户订单号,和支付宝交易号不能同时为空。 trade_no,out_trade_no如果同时存在优先取trade_no
     *
     * @param string $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->parameters['out_trade_no'] = $out_trade_no;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperatorId()
    {
        return $this->parameters['operator_id'];
    }

    /**
     * 卖家端自定义的的操作员 ID
     *
     * @param string $operator_id
     * @return $this
     */
    public function setOperatorId($operator_id = null)
    {
        $this->parameters['operator_id'] = $operator_id;
        return $this;
    }


}