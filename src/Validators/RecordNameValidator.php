<?php

/**
 *
 * 主机记录验证
 * 主机记录就是域名前缀，常见用法有：
 * www：解析后的域名为www.aliyun.com。
 * @：直接解析主域名 aliyun.com。
 *：泛解析，匹配其他所有域名 *.aliyun.com。
 * mail：将域名解析为mail.aliyun.com，通常用于解析邮箱服务器。
 * 二级域名：如：abc.aliyun.com，填写abc。
 * 手机网站：如：m.aliyun.com，填写m。
 * 显性URL：不支持泛解析（泛解析：将所有子域名解析到同一地址）
 *
 *
 * 主机记录（RR）值合法字符包含a-z、A-Z、0-9、'-' 、'_' 、'.'、'*'、'@'
 * 主机记录（RR）值不能以\“."、\“-"开头或结尾
 * 主机记录（RR）值不能以"符号"单独存在。
 * 主机记录（RR）值不能有连续的"."。
 * .分割的每个字符串长度不能超过63字符
 */

namespace DnsValidation\Validators;

class RecordNameValidator
{

    public static function validate($value)
    {

        if (in_array($value, ['@', '*'])) {
            return true;
        }

        $ipv4V = Ip4Validator::validate($value);

        if ($ipv4V) {
            return true;
        }

        if(!preg_match("/^[a-zA-Z0-9-_\.\*@]+$/", $value)){
            return false;
        }

        if(preg_match("/^[\.-]/", $value)){
            return false;
        }

        if(preg_match("/[\.-]$/", $value)){
            return false;
        }

        if(strpos($value, "..") !== false){
            return false;
        }

        $pieces = explode(".", $value);
        foreach ($pieces as $piece) {
            if (strlen($piece) > 63) {
                return false;
            }
        }

        $l = strlen($value);

        //存在且不在第一位
        if (strpos($value, '*') && $l > 1) {
            return false;
        }

        if (false !== strpos($value, '@') && $l > 1) {
            return false;
        }


        if (false !== strpos($value, '.')) {
            $record_name_arr = explode('.', $value);
            array_shift($record_name_arr);
            if (in_array('*', $record_name_arr)) {
                return false;
            }
        }


        return true;
    }


}