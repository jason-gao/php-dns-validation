<?php

namespace DnsValidation\Validators;

class SrvRecordNameValidator
{

    const REG_SRV_NAME = '/_[0-9a-zA-Z-]+\._[0-9a-zA-Z]+/i'; //服务的名字、点、协议的类型，例如：_xmpp-server._tcp

    public static function validate($value)
    {

        return (bool)preg_match(self::REG_SRV_NAME, $value);

    }
}