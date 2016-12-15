<?php

namespace Payment\Wechat\Notices;

use Payment\AbstractNotify;

/**
 * Created by PhpStorm.
 * User: lifeilin
 * Date: 2016/12/5 0005
 * Time: 18:05
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
}