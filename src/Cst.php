<?php

namespace DnsValidation;

class Cst
{


    const RECORD_TYPE_A = 'A';
    const RECORD_TYPE_4A = 'AAAA';
    const RECORD_TYPE_CNAME = 'CNAME';
    const RECORD_TYPE_MX = 'MX';
    const RECORD_TYPE_PTR = 'PTR';
    const RECORD_TYPE_NS = 'NS';
    const RECORD_TYPE_SRV = 'SRV';
    const RECORD_TYPE_TXT = 'TXT';
    const RECORD_TYPE_AP = 'AP';
    const RECORD_TYPE_CNAMEP = 'CNAMEP';
    const RECORD_TYPE_XURL = 'XURL';
    const RECORD_TYPE_YURL = 'YURL';
    const RECORD_TYPE_CAA = 'CAA';
    const RECORD_TYPE_NAPTR = 'NAPTR';


    public static function getValidRecordTypes()
    {
        return [
            self::RECORD_TYPE_A,
            self::RECORD_TYPE_4A,
            self::RECORD_TYPE_CNAME,
            self::RECORD_TYPE_MX,
            self::RECORD_TYPE_XURL,
            self::RECORD_TYPE_YURL,
            self::RECORD_TYPE_TXT,
            self::RECORD_TYPE_NS,
            self::RECORD_TYPE_SRV
        ];
    }


    const VIEW_SEARCH_ENGINE = ['searchengine', 'baidu', 'qihu', 'sougou', 'sousou', 'guge', 'weiruan', 'yahu'];

}



