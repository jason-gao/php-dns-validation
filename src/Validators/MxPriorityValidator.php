<?php

namespace DnsValidation\Validators;

class MxPriorityValidator{

    public static function validate($mx){

        return $mx >0 && $mx <= 32767;
    }
}