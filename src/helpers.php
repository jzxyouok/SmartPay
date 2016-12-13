<?php

if(!function_exists('create_random')) {

    /**
     * 生成一个指定长度的随机字符串
     * @param int $length
     * @return string
     */
    function create_random($length = 32){
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }

        return $str;
    }
}

if(!function_exists('get_millisecond')) {
    /**
     * 获取毫秒级别的时间戳
     */
    function get_millisecond(){
        //获取毫秒的时间戳
        $time = explode(" ", microtime());
        $time = $time[1] . ($time[0] * 1000);
        $time2 = explode(".", $time);
        $time = $time2[0];
        return $time;
    }
}

if(!function_exists('remove_keys')) {
    /**
     * 移除数组中的指定键的值并返回处理后的值的数组
     * @param array $handle
     * @param $needle
     * @return array
     */
    function remove_keys(array $handle,$needle){
        if(is_array($needle)){
            foreach ($needle as $key=>$value){
                unset($handle[$key]);
            }
            return array_values($handle);
        }
        unset($handle[$needle]);

        return array_values($handle);
    }
}
if(!function_exists('convert_xml')) {
    /**
     * 将数组转换为XML格式
     * @param array $values
     * @return bool|string
     */
    function convert_array_to_xml(array $values)
    {
        if (!is_array($values) || count($values) <= 0) {
            return false;
        }
        $xml = "<xml>";
        foreach ($values as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }
}

if(!function_exists('convert_xml_to_array')) {
    /**
     * 将XML转换为数组
     * @param string $xml
     * @return bool|array
     */
    function convert_xml_to_array($xml){

        if (!$xml) {
            return false;
        }
        // 检查xml是否合法
        $xml_parser = xml_parser_create();
        if (!xml_parse($xml_parser, $xml, true)) {
            xml_parser_free($xml_parser);

            return false;
        }
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $data;
    }
}

if(!function_exists('http_build_query_params')) {
    /**
     * 将数组转换成kv格式的字符串
     * @param array $params
     * @return string
     */
    function http_build_query_params(array $params){
        $buff = "";
        foreach ($params as $k => $v)
        {
            if($v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
}

if(!function_exists('rsa_encrypt')) {
    /**
     * 实现 RSA 加密
     * @param string $key
     * @param string $data
     * @return string|bool
     */
    function rsa_encrypt($key, $data){

        $res = openssl_get_privatekey($key);

        if($res === false || !openssl_sign($data, $sign, $res)){

            return false;
        }
        openssl_free_key($res);
        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }
}

if(!function_exists('rsa_decrypt')) {
    /**
     * RSA 解密
     * @param string $key
     * @param string $content
     * @return string
     */
    function rsa_decrypt($key, $content){
        $res = openssl_get_privatekey($key);
        if($res === false){
            return false;
        }
        //用base64将内容还原成二进制
        $content = base64_decode($content);
        //把需要解密的内容，按128位拆开解密
        $result  = '';
        for($i = 0; $i < strlen($content)/128; $i++  ) {
            $data = substr($content, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }
}

if(!function_exists('rsa_verify')) {
    /**
     * @param string $key 公钥
     * @param string $data 需要校验的数据
     * @param string $sign 需要校验的密文
     * @return bool
     */
    function rsa_verify($key , $data, $sign){
        // 初始时，使用公钥key
        $res = openssl_get_publickey($key);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }
}

if(!function_exists('array_value')) {
    /**
     * 获取数组中的值
     * @param string $key 键名
     * @param array $needle 数组
     * @param null $default 默认值
     * @return mixed|null
     */
    function array_value($key,array $needle,$default = null){
        if(isset($needle[$key])){
            return $needle[$key];
        }
        return $default;
    }
}