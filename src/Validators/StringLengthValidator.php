<?php

namespace DnsValidation\Validators;

class StringLengthValidator
{

    public static function validate($value, $min_length, $max_length)
    {

        $len = mb_strlen($value);

        return $len >= $min_length && $len <= $max_length;
    }
}