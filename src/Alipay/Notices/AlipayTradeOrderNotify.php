<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 17:43
 */

namespace Payment\Alipay\Notices;

/**
 * App支付结果异步通知
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.GgUBoh&treeId=193&articleId=105301&docType=1
 * @package Payment\Alipay\Notices
 */
class AlipayTradeOrderNotify extends AlipayTradeNotify
{
    protected function reply($isSuccess, $message)
    {
        return $isSuccess ? 'true' : 'fail';
    }
}