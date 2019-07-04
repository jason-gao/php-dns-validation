<?php

namespace DnsValidation\Validators;


class Int16Validator
{
    /**
     * @param $value
     * @return bool
     */
    public static function validate($value)
    {
        return $value >= 0 && $value <= 65535;
    }
}
