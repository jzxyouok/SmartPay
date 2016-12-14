<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/14 0014
 * Time: 10:34
 */

namespace Payment\Alipay\Results;

/**
 * 查询对账单下载地址结果
 *
 * @package Payment\Alipay\Results
 */
class AlipayTradeBillResult extends AlipayTradeResult
{
    public function __construct($response)
    {
        parent::__construct($response);
        $this->responseData = $this->response['alipay_data_dataservice_bill_downloadurl_query_response'];
    }

    /**
     * 账单下载地址链接，获取连接后30秒后未下载，链接地址失效
     * @return mixed|null
     */
    public function getBillDownloadUrl()
    {
        return array_value('bill_download_url',$this->responseData);
    }
}