<?php

namespace Tests;

use DnsValidation\Cst;
use DnsValidation\Validators\DefaultViewValidator;
use DnsValidation\Validators\Ip4Validator;
use DnsValidation\Validators\Ip6Validator;
use DnsValidation\Validators\RecordValueValidator;
use DnsValidation\Validators\MxPriorityValidator;
use DnsValidation\Validators\IpValidator;
use DnsValidation\Validators\RecordNameValidator;
use DnsValidation\Validators\RecordTypeValidator;
use DnsValidation\Validators\ViewsValidator;

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

    public function testA()
    {
        $value = "1.1.1.1";
        $invalidValue = "1.1.1.256";

        $this->assertTrue(Ip4Validator::validate($value));
        $this->assertFalse(Ip4Validator::validate($invalidValue));
    }

    public function test4A()
    {
        $value = "2001:0db8:3c4d:0015:0000:0000:1a2f:1a2b";
        $invalidValue = "1.1.1.1";

        $this->assertTrue(Ip6Validator::validate($value));
        $this->assertFalse(Ip6Validator::validate($invalidValue));
    }

    public function testA4A()
    {
        $ip4 = "1.1.1.1";
        $ip6 = "2001:0db8:3c4d:0015:0000:0000:1a2f:1a2b";
        $invalidIp4 = "1.1.1.1.2";
        $invalidIp6 = "2001:0db8:3c4d:0015:0000:0000:1a2f::1a2b";

        $this->assertTrue(IpValidator::validate($ip4), "ip4");
        $this->assertTrue(IpValidator::validate($ip6), "ip6");
        $this->assertFalse(Ip4Validator::validate($invalidIp4));
        $this->assertFalse(Ip6Validator::validate($invalidIp6));
    }


    public function testCname()
    {
        $value = "a.com.";
        $invalidValue = "a.com";
        $type = Cst::RECORD_TYPE_CNAME;

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $invalidValue));
    }


    public function testNs()
    {
        $value = "a.com.";
        $invalidValue = "a";
        $type = Cst::RECORD_TYPE_NS;

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $invalidValue));
    }

    public function testMx()
    {
        $value = 1;
        $invalidValue = "aaa";
        $value2 = 18888888;

        $this->assertTrue(MxPriorityValidator::validate($value));
        $this->assertFalse(MxPriorityValidator::validate($invalidValue));
        $this->assertFalse(MxPriorityValidator::validate($value2));
    }

    public function testRecordName()
    {
        $value = "www";
        $value2 = "www.a";
        $value3 = "1.1.1.1";
        $value4 = "2001:0db8:3c4d:0015:0000:0000:1a2f::1a2b";
        $value5 = "@";
        $value6 = "*";
        $value7 = "www#$-.";
        $value8 = "-www";
        $value9 = ".www";
        $value10 = "www-";
        $value11 = "www.";
        $value12 = "www..aa";
        $value13 = "www.012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789";
        $value14 = "*.a.b";
        $value15 = "a.*.a.b";
        $value16 = "*a.b.com";
        $value17 = "a.*b.c";


        $this->assertTrue(RecordNameValidator::validate($value));
        $this->assertTrue(RecordNameValidator::validate($value2));
        $this->assertTrue(RecordNameValidator::validate($value3));
        $this->assertFalse(RecordNameValidator::validate($value4));
        $this->assertTrue(RecordNameValidator::validate($value5));
        $this->assertTrue(RecordNameValidator::validate($value6));
        $this->assertFalse(RecordNameValidator::validate($value7));
        $this->assertFalse(RecordNameValidator::validate($value8));
        $this->assertFalse(RecordNameValidator::validate($value9));
        $this->assertFalse(RecordNameValidator::validate($value10));
        $this->assertFalse(RecordNameValidator::validate($value11));
        $this->assertFalse(RecordNameValidator::validate($value12));
        $this->assertFalse(RecordNameValidator::validate($value13));
        $this->assertTrue(RecordNameValidator::validate($value14));
        $this->assertFalse(RecordNameValidator::validate($value15));
        $this->assertTrue(RecordNameValidator::validate($value16));
        $this->assertFalse(RecordNameValidator::validate($value17));

    }

    public function testType()
    {
        $value = CST::RECORD_TYPE_CNAME;
        $value2 = "test";

        $this->assertTrue(RecordTypeValidator::validate($value));
        $this->assertFalse(RecordTypeValidator::validate($value2));
    }


    public function testXyUrl()
    {
        $type = Cst::RECORD_TYPE_XURL;
        $type2 = Cst::RECORD_TYPE_YURL;

        $value = "http://www.baidu.com/a";
        $value2 = "www.baidu.com";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertTrue(RecordValueValidator::validate($type, $value2));

        $this->assertTrue(RecordValueValidator::validate($type2, $value));
        $this->assertTrue(RecordValueValidator::validate($type2, $value2));
    }

    public function testSrv()
    {
        $type = Cst::RECORD_TYPE_SRV;

        $value = "5 0 5269 xmpp-server.l.google.com.";
        $value2 = " 1 2 baidu.com.";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $value2));
    }


    public function testTxt()
    {
        $type = Cst::RECORD_TYPE_TXT;

        $value = "aaa.bom";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
    }

    public function testDefaultViews()
    {
        $views = [
            "dx",
            "lt",
            "any"
        ];
        $views2 = ["dx"];

        $this->assertTrue(DefaultViewValidator::validate($views));
        $this->assertFalse(DefaultViewValidator::validate($views2));
    }


    public function testViews()
    {
        $views = [
            "dx",
            "lt"
        ];

        $view = "dx";
        $view2 = "any";

        $this->assertTrue(ViewsValidator::validate($views, $view));
        $this->assertFalse(ViewsValidator::validate($views, $view2));
    }

}
