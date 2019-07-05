<?php

namespace DnsValidation;

class Helper
{

    public static function arrFilterUnique($arr)
    {
        if (is_array($arr) && $arr) {
            return array_values(array_unique(array_filter($arr)));
        }

        return [];
    }


    public static function getValidRecordTypes()
    {
        return [
            Cst::RECORD_TYPE_A,
            Cst::RECORD_TYPE_4A,
            Cst::RECORD_TYPE_CNAME,
            Cst::RECORD_TYPE_MX,
            Cst::RECORD_TYPE_XURL,
            Cst::RECORD_TYPE_YURL,
            Cst::RECORD_TYPE_TXT,
            Cst::RECORD_TYPE_NS,
            Cst::RECORD_TYPE_SRV
        ];
    }

}