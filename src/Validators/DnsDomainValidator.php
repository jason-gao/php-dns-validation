<?php

/**
 * 云解析域名格式验证
 */

namespace DnsValidation\Validators;

class DnsDomainValidator
{

    public static function validate($value)
    {
        $pattern = '/^[a-z\d\-*@]+(\.[a-z\d\-]+)+$/';

        if (!preg_match($pattern, $value)) {
            return false;
        }


        if (!StringLengthValidator::validate($value, 0, 255)) {
            return false;
        }

        $pieces = explode(".", $value);

        //https://www.ietf.org/rfc/rfc3696.txt
        foreach ($pieces as $piece) {
            if (mb_strlen($piece) > 63) {
                return false;
            }
        }

        return true;
    }

}