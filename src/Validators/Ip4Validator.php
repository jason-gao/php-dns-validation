<?php

namespace DnsValidation\Validators;


class Ip4Validator
{
    /**
     * @param $value
     * @return bool
     */
    public static function validate($value)
    {
        return (bool)filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
}
