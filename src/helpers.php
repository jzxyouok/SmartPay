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