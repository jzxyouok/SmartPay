<?php

namespace Payment\Wechat\Notices;

use Payment\AbstractNotify;

/**
 * 微信支付回调通知
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 18:05
 * @property string $return_code
 *
 */
class WechatNotify extends AbstractNotify
{
    protected function getRequestData()
    {
        $data = @file_get_contents('php://input');
        $requestData = convert_xml_to_array($data);
        if($requestData === false || empty($requestData)){
            return false;
        }
        return $requestData;
    }

    protected function verifySign()
    {
        $data = $this->requestData;

        if (strcasecmp($data['return_code'],'SUCCESS') !== 0 || strcasecmp($data['result_code'] , 'SUCCESS') !== 0) {
            return false;
        }

        ksort($this->requestData);
        $string = $this->buildParams();
        //签名步骤二：在string后加入KEY
        $string = $string . '&key=' . $this->config->get('key');
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);

        return $result == $data['sign'];
    }

    /**
     * 获取返回给微信的数据
     * @param bool $isSuccess
     * @param string $message
     * @return bool|string
     */
    protected function reply($isSuccess, $message)
    {
        $data['return_msg'] = $message;
        if($isSuccess){
            $data ['return_code'] = 'SUCCESS';
        }else{
            $data ['return_code'] = 'FAIL ';
        }
        return convert_array_to_xml($data);
    }

    /**
     * 格式化参数格式化成url参数
     */
    protected function buildParams()
    {
        $buff = "";
        foreach ($this->requestData as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * 返回状态码
     * SUCCESS/FAIL
     * 此字段是通信标识，非交易标识，交易是否成功需要查看result_code来判断
     * @return string
     */
    public function getReturnCode()
    {
        return array_value('return_code',$this->requestData);
    }


    /**
     * 返回信息，如非空，为错误原因
     * 签名失败
     * 参数格式校验错误
     * @return string
     */
    public function getReturnMsg()
    {
        return array_value('return_msg',$this->requestData);
    }

    /**
     * 微信分配的公众账号ID（企业号corpid即为此appId）
     * @return string
     */
    public function getAppid()
    {
        return array_value('appid',$this->requestData);
    }

    /**
     * 微信支付分配的商户号
     * @return string
     */
    public function getMchId()
    {
        return array_value('mch_id',$this->requestData);
    }

    /**
     * 微信支付分配的终端设备号，
     * @return string
     */
    public function getDeviceInfo()
    {
        return array_value('device_info',$this->requestData);
    }

    /**
     * 签名
     * @return string
     */
    public function getSign()
    {
        return array_value('sign',$this->requestData);
    }

    /**
     * 随机字符串，不长于32位
     *
     * @return string
     */
    public function getNonceStr()
    {
        return array_value('nonce_str',$this->requestData);
    }

    /**
     * 签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
     * @return string
     */
    public function getSignType()
    {
        return array_value('sign_type',$this->requestData);
    }

    /**
     * 错误代码 错误返回的信息描述
     * @return string
     */
    public function getErrCode()
    {
        return array_value('err_code',$this->requestData);
    }

    /**
     * 业务结果 SUCCESS/FAIL
     * @return string
     */
    public function getResultCode()
    {
        return array_value('result_code',$this->requestData);
    }

    /**
     * 错误代码描述
     * @return string
     */
    public function getErrCodeDes()
    {
        return array_value('err_code_des',$this->requestData);
    }

    /**
     * 用户在商户appid下的唯一标识
     * @return string
     */
    public function getOpenid()
    {
        return array_value('openid',$this->requestData);
    }

    /**
     * 用户是否关注公众账号，Y-关注，N-未关注，仅在公众账号类型支付有效
     *
     * @return string
     */
    public function getIsSubscribe()
    {
        return array_value('is_subscribe',$this->requestData);
    }

    /**
     * 交易类型 JSAPI、NATIVE、APP
     * @return string
     */
    public function getTradeType()
    {
        return array_value('trade_type',$this->requestData);
    }

    /**
     * 银行类型，采用字符串类型的银行标识
     * @return string
     */
    public function getBankType()
    {
        return array_value('bank_type',$this->requestData);
    }

    /**
     * 订单总金额，单位为分
     * @return string
     */
    public function getTotalFee()
    {
        return array_value('total_fee',$this->requestData);
    }

    /**
     * 应结订单金额=订单金额-非充值代金券金额，应结订单金额<=订单金额。
     * @return string
     */
    public function getSettlementTotalFee()
    {
        return array_value('settlement_total_fee',$this->requestData);
    }

    /**
     * 货币类型，符合ISO4217标准的三位字母代码，默认人民币：CNY
     * @return string
     */
    public function getFeeType()
    {
        return array_value('fee_type',$this->requestData);
    }

    /**
     * 现金支付金额订单现金支付金额
     * @return string
     */
    public function getCashFee()
    {
        return array_value('cash_fee',$this->requestData);
    }

    /**
     * 货币类型，符合ISO4217标准的三位字母代码，默认人民币：CNY
     * @return string
     */
    public function getCashFeeType()
    {
        return array_value('cash_fee_type',$this->requestData);
    }

    /**
     * 代金券金额<=订单金额，订单金额-代金券金额=现金支付金额
     * @return string
     */
    public function getCouponFee()
    {
        return array_value('coupon_fee',$this->requestData);
    }

    /**
     * 代金券使用数量
     * @return string
     */
    public function getCouponCount()
    {
        return array_value('coupon_count',$this->requestData);
    }

    /**
     * 代金券类型
     *
     * CASH--充值代金券
     * NO_CASH---非充值代金券
     * 订单使用代金券时有返回（取值：CASH、NO_CASH）。$n为下标,从0开始编号，举例：coupon_type_0
     * @return string
     */
    public function getCouponType()
    {
        return $this->matchValue('coupon_type_');
    }

    /**
     * 代金券ID,$n为下标，从0开始编号
     *
     * @return string
     */
    public function getCouponId()
    {
        return $this->matchValue('coupon_id_');
    }

    /**
     *  单个代金券支付金额,$n为下标，从0开始编号
     * @return string
     */
    public function getCouponFees()
    {
        return $this->matchValue('coupon_fee_');
    }

    /**
     * 微信支付订单号
     * @return string
     */
    public function getTransactionId()
    {
        return array_value('transaction_id',$this->requestData);
    }

    /**
     * 商户系统的订单号，与请求一致。
     * @return string
     */
    public function getOutTradeNo()
    {
        return array_value('out_trade_no',$this->requestData);
    }

    /**
     * 商家数据包，原样返回
     * @return string
     */
    public function getAttach()
    {
        return array_value('attach',$this->requestData);
    }

    /**
     *  支付完成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010。
     *
     * @return string
     */
    public function getTimeEnd()
    {
        return array_value('time_end',$this->requestData);
    }


    /**
     * 获取多下标的数组数据
     * @param string $name 匹配名称
     * @param null $pattern 需要的正则匹配
     * @return array|null
     */
    protected function matchValue($name,$pattern = null)
    {
        if(isset($this->cache['array_' . $name])){
            return $this->cache['array_' .$name];
        }
        $results = [];
        foreach ($this->requestData as $key=>$value){
            if(stripos($key,$name) === 0){
                if($pattern !== null){
                    if(preg_match($pattern,$key)){
                        $results[$key] = $value;
                    }
                }else{
                    $results[$key] = $value;
                }
            }
        }
        $this->cache['array_' .$name] = $results;
        return $results;
    }
}
