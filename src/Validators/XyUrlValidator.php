<?php

namespace DnsValidation\Validators;

class XyUrlValidator
{

    const RECORD_MAX_XY_URL_LEN = 200;
    const REG_XY_URL = '/^(https?:\/\/)?(([\w\-\._]+\.([a-z\.]{2,6}))|(((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)))(\:[0-6]?[0-9]{1,4})?(\/[^\s]*)?$/i';

    public static function validate($value)
    {

        return (bool)preg_match(self::REG_XY_URL, $value);
    }
}