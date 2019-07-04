<?php


namespace DnsValidation\Validators;


class Ip6Validator
{
    /**
     * @param $value
     * @return bool
     */
    public static function validate($value)
    {
        return (bool)filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }
}
