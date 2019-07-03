<?php

namespace DnsValidation\Validators;

use DnsValidation\Cst;

class RecordTypeValidator{


    public static function validate($value){
        $types = Cst::getValidRecordTypes();

        if(in_array($value, $types)){
            return true;
        }

        return false;
    }

}