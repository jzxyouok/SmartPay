<?php
/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 15:27
 */

namespace Payment\Wechat\Parameters;


use Payment\AbstractParameter;

/**
 * 微信支付参数基类
 * Class WechatParameter
 * @package Payment\Wechat
 */
abstract class WechatParameter extends AbstractParameter
{

    protected function createSign()
    {
        //签名步骤一：按字典序排序参数
        ksort($this->requestData);
        $string = $this->buildParams();
        //签名步骤二：在string后加入KEY
        $string = $string . '&key=' . $this->config->get('key');
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);

        return $result;
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
}