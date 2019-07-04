<?php

namespace DnsValidation\Validators;

class ViewsValidator{

    /**
     * @param $views
     * @param $view
     * @return bool
     *
     * views根据自己业务传递进来
     */
    public static function validate($views, $view){

        return in_array($view, $views);
    }
}