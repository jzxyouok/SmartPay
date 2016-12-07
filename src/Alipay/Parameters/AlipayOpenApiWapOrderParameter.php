<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/6 0006
 * Time: 17:53
 */

namespace Payment\Alipay\Parameters;


use Payment\Exceptions\PaymentException;
use Payment\Parameters\OrderParameter;
use Payment\Support\Traits\AlipayParameterTrait;

/**
 * 手机网页(WAP)支付 【蚂蚁金服开放平台支付接口】
 * @link  https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.QVJYfD&treeId=203&articleId=105288&docType=1
 * Class AlipayWapOrderParameter
 * @package Payment\Alipay\Parameters
 */
class AlipayOpenApiWapOrderParameter extends OrderParameter
{
    use AlipayParameterTrait;
    protected $method = 'alipay.trade.wap.pay';

    protected function buildData()
    {
        $timeExpire = $this->timeExpire;
        $signData = [
            // 基本参数
            'app_id'   => $this->appid,
            'method'    => 'alipay.trade.wap.pay',
            'format'    => 'JSON',
            'return_url'    => $this->return_url
        ];
        if (! empty($timeExpire)) {
            $signData['it_b_pay'] = trim($this->timeExpire) . 'm';// 超时时间 统一使用分钟计算
        }
    }

    protected function checkDataParams()
    {
        // TODO: Implement checkDataParams() method.
    }

}