<?php


namespace DnsValidation\Validators;


class TtlValidator
{
    /**
     * @param int $value
     * @return bool
     */
    public static function validate($value)
    {
        return $value >= 0 && $value <= 2147483647;
    }
}
