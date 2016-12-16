<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/16 0016
 * Time: 11:07
 */

namespace Payment\Wechat\Results;

/**
 * 撤销订单API
 * @link https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=9_11&index=3
 *
 * @package Payment\Wechat\Results
 *
 */
class WechatReverseResult extends WechatResult
{
    /**
     * 是否需要继续调用撤销，Y-需要，N-不需要
     *
     * @return mixed|null
     */
    public function getRecall()
    {
        return $this->getValue('recall');
    }
}