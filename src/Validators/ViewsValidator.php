<?php

namespace DnsValidation\Validators;

use DnsValidation\Helper;

class ViewsValidator{

    /**
     * @param $views
     * @param $view
     * @return bool
     *
     * views根据自己业务传递进来
     */
    public static function validate($views, $view){

        $views = Helper::arrFilterUnique($views);

        return in_array($view, $views);
    }
}