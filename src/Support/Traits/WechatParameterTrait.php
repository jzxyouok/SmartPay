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

    /**
     * 加密密钥
     * @param $key
     * @return mixed
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * 加密密钥
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
    /**
     *  微信分配的公众账号ID（企业号corpid即为此appId）
     * @return string
     */
    public function getAppId()
    {
        return $this->appid;
    }

    /**
     *  微信分配的公众账号ID（企业号corpid即为此appId）
     * @param string $appid
     * @return mixed
     */
    public function setAppId($appid)
    {
        $this->appid = $appid;
        return $this;
    }

    /**
     * 微信支付分配的商户号
     * @return string
     */
    public function getMchId()
    {
        return $this->mch_id;
    }

    /**
     * 微信支付分配的商户号
     * @param string $mch_id
     * @return mixed
     */
    public function setMchId($mch_id)
    {
        $this->mch_id = $mch_id;
        return $this;
    }

    /**
     * 随机字符串，长度要求在32位以内。推荐随机数生成算法
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_3
     * @return string
     */
    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    /**
     *  随机字符串，长度要求在32位以内。推荐随机数生成算法
     * @link https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_3
     * @param string $nonce_str
     * @return mixed
     */
    public function setNonceStr($nonce_str = null)
    {
        if($nonce_str === null){
            $nonce_str = create_random(32);
        }
        $this->nonce_str = $nonce_str;
        return $this;
    }

    /**
     * 通过签名算法计算得出的签名值
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
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