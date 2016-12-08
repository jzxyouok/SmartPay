<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/8 0008
 * Time: 13:39
 */

namespace Payment\Alipay\Notices;


use Payment\Configuration\PayConfiguration;

/**
 * 手机支付退款通知结果
 *
 * @link https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.GhyLH2&treeId=60&articleId=104744&docType=1#s4
 *
 * Class AlipayWapRefundNotify
 * @package Payment\Alipay\Notices
 */
class AlipayWapRefundNotify extends AlipayWapNotify
{
    public function __construct(PayConfiguration $config)
    {
        parent::__construct($config);
    }

    /**
     * 退款批次号
     * @return mixed
     */
    public function getBatchNo()
    {
        return isset($this->requestData['notify_time']) ? $this->requestData['notify_time'] : null;
    }

    /**
     * 退交易成功的笔数。
     * 0<= success_num<= 总退款笔数。
     * @return null
     */
    public function getSuccessNum()
    {
        return isset($this->requestData['success_num']) ? $this->requestData['success_num'] : null;
    }

    /**
     * 退款结果明细
     *
     * 退手续费结果返回格式：交易号^退款金额^处理结果$退费账号^退费账户ID^退费金额^处理结果；
     * 不退手续费结果返回格式：交易号^退款金额^处理结果。
     * 若退款申请提交成功，处理结果会返回“SUCCESS”
     * @return null
     */
    public function getResultDetails()
    {
        return isset($this->requestData['result_details']) ? $this->requestData['result_details'] : null;
    }
}