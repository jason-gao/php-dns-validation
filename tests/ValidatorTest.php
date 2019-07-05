<?php

namespace Tests;

use DnsValidation\Cst;
use DnsValidation\Validators\ConflictRecordTypeValidator;
use DnsValidation\Validators\DefaultViewValidator;
use DnsValidation\Validators\DnsDomainValidator;
use DnsValidation\Validators\DotEndingValidator;
use DnsValidation\Validators\Ip4Validator;
use DnsValidation\Validators\Ip6Validator;
use DnsValidation\Validators\RecordValueValidator;
use DnsValidation\Validators\MxPriorityValidator;
use DnsValidation\Validators\IpValidator;
use DnsValidation\Validators\RecordNameValidator;
use DnsValidation\Validators\RecordTypeValidator;
use DnsValidation\Validators\SrvRecordNameValidator;
use DnsValidation\Validators\StringLengthValidator;
use DnsValidation\Validators\TtlValidator;
use DnsValidation\Validators\ViewsValidator;

error_reporting(0);

class ValidatorTest extends TestCase
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


    public function testDnsDomain()
    {
        $value = "www.a.com";
        $value2 = "a-bc.com";
        $value3 = "a.com#";
        $value4 = ".a.com";
        $value5 = "*.a.com";
        $value6 = str_repeat("a.com", 500);
        $value7 = "";
        $value8 = "a" . str_repeat("a", 100) . ".com";

        $this->assertTrue(DnsDomainValidator::validate($value));
        $this->assertTrue(DnsDomainValidator::validate($value2));
        $this->assertFalse(DnsDomainValidator::validate($value3));
        $this->assertFalse(DnsDomainValidator::validate($value4));
        $this->assertTrue(DnsDomainValidator::validate($value5));
        $this->assertFalse(DnsDomainValidator::validate($value6));
        $this->assertFalse(DnsDomainValidator::validate($value7));
        $this->assertFalse(DnsDomainValidator::validate($value8));
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
        $value2 = "-a.com.";
        $type = Cst::RECORD_TYPE_NS;

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $invalidValue));
        $this->assertFalse(RecordValueValidator::validate($type, $value2));
    }

    public function testMxPri()
    {
        $value = 1;
        $invalidValue = "aaa";
        $value2 = 18888888;

        $this->assertTrue(MxPriorityValidator::validate($value));
        $this->assertFalse(MxPriorityValidator::validate($invalidValue));
        $this->assertFalse(MxPriorityValidator::validate($value2));
    }


    public function testRecordValueMx()
    {
        $type = Cst::RECORD_TYPE_MX;

        $value = "1.1.1.1.";
        $value2 = "a.com.";
        $value3 = "www.a.com.";
        $value4 = "a";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertTrue(RecordValueValidator::validate($type, $value2));
        $this->assertTrue(RecordValueValidator::validate($type, $value3));
        $this->assertFalse(RecordValueValidator::validate($type, $value4));
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
        $value18 = "@.a.com";
        $value19 = "*.a.b.*.c";


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
        $this->assertFalse(RecordNameValidator::validate($value18));
        $this->assertFalse(RecordNameValidator::validate($value19));

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
        $value3 = str_repeat("a", 201);
        $value4 = "http://a.com";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertTrue(RecordValueValidator::validate($type, $value2));
        $this->assertTrue(RecordValueValidator::validate($type2, $value));
        $this->assertTrue(RecordValueValidator::validate($type2, $value2));
        $this->assertFalse(RecordValueValidator::validate($type, $value3));
        $this->assertFalse(RecordValueValidator::validate($type2, $value3));
        $this->assertTrue(RecordValueValidator::validate($type, $value4));
    }

    public function testRecordValueMax(){

        $value = str_repeat("a", 256);
        $type = Cst::RECORD_TYPE_TXT;

        $this->assertFalse(RecordValueValidator::validate($type, $value));
    }

    public function testSrv()
    {
        $type = Cst::RECORD_TYPE_SRV;

        $value = "5 0 5269 xmpp-server.l.google.com.";
        $value2 = " 1 2 baidu.com.";
        $value3 = "a";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $value2));
        $this->assertFalse(RecordValueValidator::validate($type, $value3));
    }


    public function testTxt()
    {
        $type = Cst::RECORD_TYPE_TXT;

        $value = "aaa.bom";
        $value2 = "v=spf1 ip4:222.73.10.252 ip4:61.152.91.23 ~all";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertTrue(RecordValueValidator::validate($type, $value2));
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

    public function testSrvName()
    {
        $value = "_xmpp-server._tcp";
        $value2 = "aaa";

        $this->assertTrue(SrvRecordNameValidator::validate($value));
        $this->assertFalse(SrvRecordNameValidator::validate($value2));
    }


    public function testConflict()
    {
        //A
        $value = [
            CST::RECORD_TYPE_MX,
            CST::RECORD_TYPE_A,
            CST::RECORD_TYPE_CNAME,
            CST::RECORD_TYPE_NS,
        ];

        $value2 = [
            CST::RECORD_TYPE_A,
            CST::RECORD_TYPE_TXT,
        ];

        $this->assertFalse(ConflictRecordTypeValidator::validate($value));
        $this->assertTrue(ConflictRecordTypeValidator::validate($value2));

        //4A
        $value3 = [
            CST::RECORD_TYPE_4A,
            CST::RECORD_TYPE_XURL,
        ];

        $value4 = [
            CST::RECORD_TYPE_4A,
            CST::RECORD_TYPE_NS,
        ];

        $this->assertFalse(ConflictRecordTypeValidator::validate($value3));
        $this->assertTrue(ConflictRecordTypeValidator::validate($value4));
    }


    public function testTtl()
    {
        $value = 0;
        $value2 = 1;
        $value3 = -1;
        $value4 = 2147483648;

        $this->assertTrue(TtlValidator::validate($value));
        $this->assertTrue(TtlValidator::validate($value2));
        $this->assertFalse(TtlValidator::validate($value3));
        $this->assertFalse(TtlValidator::validate($value4));
    }


    public function testDotEnding()
    {
        $value = "a.com";
        $value2 = "a.com.";
        $value3 = "";

        $this->assertFalse(DotEndingValidator::validate($value));
        $this->assertTrue(DotEndingValidator::validate($value2));
        $this->assertFalse(DotEndingValidator::validate($value3));
    }

    public function testStringLength()
    {
        $value = "a.com";
        $min = 1;
        $max = 10;
        $max2 = 2;

        $this->assertTrue(StringLengthValidator::validate($value, $min, $max));
        $this->assertFalse(StringLengthValidator::validate($value, $min, $max2));
    }

    public function testRecordValueIp4()
    {
        $type = Cst::RECORD_TYPE_A;
        $value = "1.1.1.1";
        $value2 = "1.1.1";


        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $value2));
    }

    public function testRecordValueIp6()
    {
        $type = Cst::RECORD_TYPE_4A;
        $value = "2001:0db8:3c4d:0015:0000:0000:1a2f:1a2b";
        $value2 = "2001:0db8:3c4d:0015:0000:0000:1a2f";

        $this->assertTrue(RecordValueValidator::validate($type, $value));
        $this->assertFalse(RecordValueValidator::validate($type, $value2));
    }


}
