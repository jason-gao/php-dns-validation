<?php

namespace DnsValidation\Validators;

class DefaultViewValidator{


    const VIEW_DEFAULT = 'any';

    public static function validate($view, $recordList){

        $views = array_column($recordList, 'view');

        return in_array($view, $views);

    }
}