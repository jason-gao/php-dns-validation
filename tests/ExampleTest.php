<?php

namespace Tests;

use DnsValidation\Cst;
use DnsValidation\Validators\Ip4Validator;
use DnsValidation\Validators\Ip6Validator;
use DnsValidation\Validators\RecordValueValidator;
use DnsValidation\Validators\MxPriorityValidator;

error_reporting(0);

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testA(){
        $value = "1.1.1.1";

        $this->assertTrue(Ip4Validator::validate($value));
    }

    public function test4A(){
        $value = "2001:0db8:3c4d:0015:0000:0000:1a2f:1a2b";

        $this->assertTrue(Ip6Validator::validate($value));
    }


    public function testCname(){
        $value = "a.com.";
        $type = Cst::RECORD_TYPE_CNAME;

        $this->assertTrue(RecordValueValidator::validate($type, $value));
    }


    public function testNs(){
        $value = "a.com.";
        $type = Cst::RECORD_TYPE_NS;

        $this->assertTrue(RecordValueValidator::validate($type, $value));
    }

    public function testMx(){
        $value = 1;

        $this->assertTrue(MxPriorityValidator::validate($value));
    }

    public function testRecordName(){

    }

}
