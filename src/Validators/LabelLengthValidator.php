<?php

/**
 *   https://www.ietf.org/rfc/rfc3696.txt
 */

namespace DnsValidation\Validators;

class LabelLengthValidator
{

    public static function validate($value)
    {
        $labels = explode(".", $value);
        foreach ($labels as $label) {
            if (strlen($label) > 63) {
                return false;
            }
        }

        return true;
    }

}