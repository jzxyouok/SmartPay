<?php

namespace Payment\Support\Traits;

use Payment\Exceptions\PaymentException;

trait WechatParameterTrait
{
    /**
     * @var string key不参与加密因此单独处理
     */
    public $key;
    public function __construct($appid,$mchid,$key)
    {
        parent::__construct($appid);
        $this->mch_id = $mchid;
        $this->key = $key;
    }
    protected function createSign()
    {
        $data = array();

        foreach ($this->requestData as $key=>$value){
            if($value != "" && !is_array($value)){
                $data[$key] = $value;
            }
        }

        unset($data['sign']);

        //签名步骤一：按字典序排序参数
        ksort($data);

        $string = http_build_query_params($data);
        //签名步骤二：在string后加入KEY
        $string = $string . '&key=' . $this->key;

      //  echo $string;exit();
        if(isset($this->requestData['sign_type']) && $this->requestData['sign_type'] == 'HMAC-SHA256'){
            $string = hash_hmac('sha256',$string,$this->key);
           // echo $string;exit;
        }else {
            //签名步骤三：MD5加密
            $string = md5($string);
        }
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);

        return $result;
    }
}