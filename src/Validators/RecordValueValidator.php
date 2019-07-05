<?php

namespace DnsValidation\Validators;

use DnsValidation\Cst;

class RecordValueValidator
{

    const REG_DNS_DOMAIN = "/^([A-Z0-9][A-Z0-9_-]*(\.[A-Z0-9][A-Z0-9_-]*)*(\.[A-Z]+)+)(:\d+)?$/i";

    public static function validate($type, $value)
    {
        if (!StringLengthValidator::validate($value, 1, 255)) {
            return false;
        }

        switch ($type) {
            case Cst::RECORD_TYPE_A:
                return Ip4Validator::validate($value);
                break;
            case Cst::RECORD_TYPE_4A:
                return Ip6Validator::validate($value);
                break;
            case Cst::RECORD_TYPE_CNAME:
            case Cst::RECORD_TYPE_NS:
                if (!DotEndingValidator::validate($value)) {
                    return false;
                }
                $valueF = trim($value, '.');
                if (!preg_match(self::REG_DNS_DOMAIN, $valueF)) {
                    return false;
                }
                break;
            case Cst::RECORD_TYPE_MX:
                if (!DotEndingValidator::validate($value)) {
                    return false;
                }
                $valueF = trim($value, '.');
                return Ip4Validator::validate($valueF) || DnsDomainValidator::validate($valueF);
                break;
            case Cst::RECORD_TYPE_XURL:
            case Cst::RECORD_TYPE_YURL:
                if (strlen($value) > XyUrlValidator::RECORD_MAX_XY_URL_LEN) {
                    return false;
                }
                return XyUrlValidator::validate($value);
                break;
            case Cst::RECORD_TYPE_TXT:
                return StringLengthValidator::validate($value, 1, 255);
                break;
            case Cst::RECORD_TYPE_SRV:
                if (!DotEndingValidator::validate($value)) {
                    return false;
                }
                $valueF = trim($value, '.');
                return SrvRecordValueValidator::validate($valueF);
                break;
        }

        return true;
    }
}