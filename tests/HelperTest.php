<?php

namespace Tests;

use DnsValidation\Helper;

error_reporting(0);

class HelperTest extends TestCase{

    public function testArrFilterUnique(){

        $value = "";

        $this->assertEmpty(Helper::arrFilterUnique($value));
    }


}