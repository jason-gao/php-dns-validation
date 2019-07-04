<?php

namespace DnsValidation\Validators;

class SrvRecordValueValidator
{

    const REG_SRV_VALUE = '/^\d+\s\d+\s\d+\s[0-9a-zA-Z-_\.]+/i'; //优先级、空格、权重、空格、端口、空格、主机名  5 0 5269 xmpp-server.l.google.com.

    public static function validate($value)
    {
        list($priority, $weight, $port) = explode(" ", $value);

        return Int16Validator::validate($priority) &&
            Int16Validator::validate($weight) &&
            Int16Validator::validate($port) &&
            preg_match(self::REG_SRV_VALUE, $value);

    }
}