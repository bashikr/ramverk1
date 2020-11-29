<?php

namespace Bashar\WeatherModel;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpValidatorTest extends TestCase
{

    private $controller;


    /**
     * SetUp
     */
    public function setUp() : void
    {
        $this->controller = new IpValidator();
    }

    /**
     * Test the route "index".
     */
    public function testGetIncorrectIpInput()
    {
        $test = "f";
        $res = $this->controller->validateIpInput($test);
        $this->assertFalse($res);
    }

    /**
     * Test the route "index".
     */
    public function testGetCorrectIpInput()
    {
        $testIPv6 = "fe80::fc6c:65db:a743:60a7";
        $res1 = $this->controller->validateIpInput($testIPv6);
        $this->assertFalse($res1);

        $testIPv4 = "192.168.56.1";
        $res2 = $this->controller->validateIpInput($testIPv4);
        $this->assertTrue($res2);
    }

}
