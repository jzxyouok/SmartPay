<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/15 0015
 * Time: 10:27
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\AbstractParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单交易结算接口
 * 用于在线下场景交易支付后，进行结算
 * @link https://doc.open.alipay.com/docs/api.htm?spm=a219a.7395905.0.0.CVWgAP&docType=4&apiId=1147
 * @package Payment\Alipay\Parameters
 *
 * @property string $operator_id
 *
 */
class AlipayTradeSettleParameter extends AbstractParameter
{
    protected $method = 'alipay.trade.order.settle';
    use AlipayParameterTrait;
    protected $parameters = [
        'out_request_no'        => null,
        'trade_no'              => null,
        'royalty_parameters'    => null,
        'operator_id'           => null
    ];

    protected function buildData()
    {
        $params = [];

        foreach ($this->parameters as $key => $parameter){
            if(empty($parameter) === false){
                $params[$key] = $parameter;
            }
        }
        $this->parameter->checkParams();

        $data = $this->parameter->getData();

        $data['biz_content'] = json_encode($params, JSON_UNESCAPED_UNICODE);

        $this->requestData = $data;
    }
    protected function checkDataParams()
    {
        if(empty($this->parameters['out_request_no']) || strlen($this->parameters['out_request_no']) > 64){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 out_request_no 或长度超过64字');
        }
        if(empty($this->parameters['trade_no']) || strlen($this->parameters['trade_no']) > 64){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 trade_no 或长度超过64字');
        }
        if(empty($this->parameters['royalty_parameters'])){
            throw new PaymentException('提交被扫支付API接口中，缺少必填参数 royalty_parameters	 ');
        }
        if(mb_strlen($this->parameters['operator_id']) > 64){
            throw new PaymentException('operator_id 不能大于64字');
        }
    }

    /**
     * 结算请求流水号
     * @return string
     */
    public function getOutRequestNo()
    {
        return $this->parameters['out_request_no'];
    }

    /**
     * 结算请求流水号
     * @param string $out_request_no
     */
    public function setOutRequestNo($out_request_no)
    {
        $this->parameters['out_request_no'] = $out_request_no;
    }

    /**
     * 支付宝订单号
     * @return string
     */
    public function getTradeNo()
    {
        return $this->parameters['trade_no'];
    }

    /**
     * 支付宝订单号
     * @param string $trade_no
     */
    public function setTradeNo($trade_no)
    {
        $this->parameters['trade_no'] = $trade_no;
    }

    /**
     * 分账明细信息
     * @return array
     */
    public function getRoyaltyParameters()
    {
        return $this->parameters['royalty_parameters'];
    }

    /**
     * 分账明细信息
     *
     * $royalty_parameters['trans_out']         分账支出方账户，类型为userId，本参数为要分账的支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。
     * $royalty_parameters['trans_in']          分账收入方账户，类型为userId，本参数为要分账的支付宝账号对应的支付宝唯一用户号。以2088开头的纯16位数字。
     * $royalty_parameters['amount']            分账的金额，单位为元
     * $royalty_parameters['amount_percentage'] 分账信息中分账百分比。取值范围为大于0，少于或等于100的整数。
     * $royalty_parameters['desc']              分账描述
     *
     * @param array $royalty_parameters
     *
     */
    public function setRoyaltyParameters(array $royalty_parameters)
    {
        $this->parameters['royalty_parameters'] = $royalty_parameters;
    }

    /**
     * 操作员id
     * @return string
     */
    public function getOperatorId()
    {
        return $this->parameters['operator_id'];
    }

    /**
     * 操作员id
     * @param string $operator_id
     */
    public function setOperatorId($operator_id = null)
    {
        $this->parameters['operator_id'] = $operator_id;
    }


}