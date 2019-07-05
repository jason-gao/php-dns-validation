<?php

namespace DnsValidation\Exception;

use EXception;

class InvalidException extends Exception
{

    const MSG = "invalid";
    const CODE = 0;

    public function __construct($message = "", $code = null,  $previous = null)
    {
        $message = $message ? $message : self::MSG;
        $code = $code ? $code : self::CODE;
        parent::__construct($message, $code, $previous);
    }

}