<?php

/**
 * 验证记录类型冲突
 */
namespace DnsValidation\Validators;

use DnsValidation\Cst;

class ConflictRecordTypeValidator
{

    public static function validate($record_types = [])
    {
        $all_types = self::getRecordRules();
        $check_valid = true;
        foreach ($record_types as $key => $type_x) {
            $types = $record_types;
            unset($types[$key]);
            $types = array_unique($types);
            foreach ($types as $type_y) {
                if (!isset($all_types[$type_x][$type_y]) || !$all_types[$type_x][$type_y]) {
                    $check_valid = false;
                    break 2;
                }
            }
        }
        return $check_valid;
    }


    /**
     * @return array
     *
     * 验证各种记录类型之间的互斥规则:1-允许同时存在，0-不允许同时存在
     */
    private static function getRecordRules()
    {
        return [
            Cst::RECORD_TYPE_A => [
                Cst::RECORD_TYPE_A => 1,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 0,
                Cst::RECORD_TYPE_CNAMEP => 0,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,
            ],
            Cst::RECORD_TYPE_CNAME => [
                Cst::RECORD_TYPE_A => 0,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 0,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 0,
                Cst::RECORD_TYPE_CNAMEP => 0,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,

            ],
            Cst::RECORD_TYPE_NS => [
                Cst::RECORD_TYPE_A => 1,
                Cst::RECORD_TYPE_CNAME => 1,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 1,
                Cst::RECORD_TYPE_CNAMEP => 1,
                Cst::RECORD_TYPE_XURL => 1,
                Cst::RECORD_TYPE_YURL => 1,

            ],
            Cst::RECORD_TYPE_MX => [
                Cst::RECORD_TYPE_A => 1,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 1,
                Cst::RECORD_TYPE_CNAMEP => 0,
                Cst::RECORD_TYPE_XURL => 1,
                Cst::RECORD_TYPE_YURL => 1,

            ],
            Cst::RECORD_TYPE_TXT => [
                Cst::RECORD_TYPE_A => 1,
                Cst::RECORD_TYPE_CNAME => 1,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 1,
                Cst::RECORD_TYPE_CNAMEP => 1,
                Cst::RECORD_TYPE_XURL => 1,
                Cst::RECORD_TYPE_YURL => 1,

            ],
            Cst::RECORD_TYPE_4A => [
                Cst::RECORD_TYPE_A => 1,
                Cst::RECORD_TYPE_CNAME => 1,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 1,
                Cst::RECORD_TYPE_CNAMEP => 1,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,

            ],
            Cst::RECORD_TYPE_AP => [
                Cst::RECORD_TYPE_A => 0,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 1,
                Cst::RECORD_TYPE_CNAMEP => 0,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,

            ],
            Cst::RECORD_TYPE_CNAMEP => [
                Cst::RECORD_TYPE_A => 0,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 0,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 1,
                Cst::RECORD_TYPE_AP => 0,
                Cst::RECORD_TYPE_CNAMEP => 1,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,

            ],

            Cst::RECORD_TYPE_XURL => [
                Cst::RECORD_TYPE_A => 0,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 0,
                Cst::RECORD_TYPE_AP => 0,
                Cst::RECORD_TYPE_CNAMEP => 0,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,

            ],
            Cst::RECORD_TYPE_YURL => [
                Cst::RECORD_TYPE_A => 0,
                Cst::RECORD_TYPE_CNAME => 0,
                Cst::RECORD_TYPE_NS => 1,
                Cst::RECORD_TYPE_MX => 1,
                Cst::RECORD_TYPE_TXT => 1,
                Cst::RECORD_TYPE_4A => 0,
                Cst::RECORD_TYPE_AP => 0,
                Cst::RECORD_TYPE_CNAMEP => 0,
                Cst::RECORD_TYPE_XURL => 0,
                Cst::RECORD_TYPE_YURL => 0,

            ]
        ];
    }

}