<?php

namespace DnsValidation\Validators;

class DotEndingValidator{

    public static function validate($value){

        if(empty($value)){
            return false;
        }

        if($value[strlen($value)-1] == "."){
            return true;
        }

        return true;
    }

}