<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:21
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\TradeParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 统一收单交易支付接口
 * <p>收银员使用扫码设备读取用户手机支付宝“付款码”/声波获取设备（如麦克风）读取用户手机支付宝的声波信息后，将二维码或条码信息/声波信息通过本接口上送至支付宝发起支付。</p>
 * Class AlipayTradeParameter
 * @package Payment\Alipay\Parameters
 */
class AlipayTradeParameter extends TradeParameter
{
    use AlipayParameterTrait;

    protected function buildData()
    {

    }

    protected function createSign()
    {
        // TODO: Implement createSign() method.
    }

    protected function checkDataParams()
    {
        // TODO: Implement checkDataParams() method.
    }

}