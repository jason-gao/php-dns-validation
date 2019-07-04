<?php

namespace DnsValidation\Validators;

class MxPriorityValidator{

    public static function validate($mx){
        $mx = (int)$mx;

        return $mx >0 && $mx <= 32767;
    }
}