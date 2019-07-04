<?php

namespace DnsValidation\Validators;

class IpValidator{


    public static function validate($value){
        return (bool)filter_var($value, FILTER_VALIDATE_IP);
    }
}