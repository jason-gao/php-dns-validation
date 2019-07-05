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


        if (!StringLengthValidator::validate($value, 1, 255)) {
            return false;
        }

        if(!LabelLengthValidator::validate($value)){
            return false;
        }

        return true;
    }

}