<?php
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

    protected function verifySign(array $data)
    {
        if (strcasecmp($data['return_code'],'SUCCESS') !== 0 || strcasecmp($data['result_code'] , 'SUCCESS') !== 0) {
            return false;
        }

        return false;
    }

    protected function reply($message)
    {
        // TODO: Implement reply() method.
    }

}