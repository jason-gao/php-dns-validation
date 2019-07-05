<?php

namespace DnsValidation\Validators;

use DnsValidation\Helper;

class DefaultViewValidator
{


    const VIEW_DEFAULT = 'any';

    public static function validate($views)
    {
        $views = Helper::arrFilterUnique($views);
        return in_array(self::VIEW_DEFAULT, $views);

    }
}