<?php

/**
 * 记录类型验证
 */

namespace DnsValidation\Validators;

use DnsValidation\Helper;


class RecordTypeValidator{

    public static function validate($value){
        $types = Helper::getValidRecordTypes();

        if(in_array($value, $types)){
            return true;
        }

        return false;
    }

}