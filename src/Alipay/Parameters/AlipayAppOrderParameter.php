<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:43
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\OrderParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * Class AlipayAppOrderParameter
 * @package Payment\Alipay\Parameters
 *
 */
class AlipayAppOrderParameter extends OrderParameter
{
    use AlipayParameterTrait;

    protected function buildData()
    {
        $timeExpire = $this->time_expire;

        $signData = [
            // 基本参数
            'service'   => '"' . 'mobile.securitypay.pay' . '"',
            'partner'   => '"' . trim($this->partner) . '"',
            '_input_charset'   => '"' . trim($this->inputCharset) . '"',
            'sign_type'   => '"' . trim($this->signType) . '"',
            'notify_url'    => '"' . trim($this->notifyUrl) . '"',
            // 业务参数
            'out_trade_no'  => '"' . trim($this->order_no) . '"',
            'subject'   => '"' . trim($this->subject) . '"',
            'payment_type'  => '"' . 1 . '"',
            'seller_id' => '"' . trim($this->partner) . '"',
            'total_fee' => '"' . trim($this->amount) . '"',
            'body'  => '"' . trim($this->body) . '"',
            'goods_type'    => '"' . 1 . '"', //默认为实物类型
        ];
        if (! empty($timeExpire)) {
            $signData['it_b_pay'] = '"' . trim($this->timeExpire) . 'm"';// 超时时间 统一使用分钟计算
        }

    }

    protected function checkDataParams()
    {
        // TODO: Implement checkDataParams() method.
    }

}