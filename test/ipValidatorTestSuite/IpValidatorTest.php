<?php

namespace Bashar\IpValidator;

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
        $this->assertContains('The IP-address ' . '<p style="color:red; font-weight: 900;">' . $test .
        '</p>' . ' is not valid.', $res);
    }

    /**
     * Test the route "index".
     */
    public function testGetCorrectIpInput()
    {
        $testIPv6 = "fe80::fc6c:65db:a743:60a7";
        $res1 = $this->controller->validateIpInput($testIPv6);
        $this->assertContains('The IP-address ' . '<p style="color:#69a542; font-weight: 900;">' . $testIPv6 . '</p>' .
        ' is a valid  IPv6 IP-address.', $res1);

        $testIPv4 = "192.168.56.1";
        $res2 = $this->controller->validateIpInput($testIPv4);
        $this->assertContains('The IP-address ' . '<p style="color:#69a542; font-weight: 900;">' . $testIPv4 . '</p>' .
        ' is a valid IPv4 IP-address.', $res2);
    }

    /**
     * Test the route "index".
     */
    public function testTheReturnedDomainIsPositive()
    {
        $testIPv6 = "fe80::fc6c:65db:a743:60a7";
        $res1 = $this->controller->getTheIpDomainName($testIPv6);
        $this->assertContains('<p style="color:green; font-weight: 900;">' . gethostbyaddr($testIPv6) .'</p>', $res1);

        $testIPv4 = "192.168.56.1";
        $res2 = $this->controller->getTheIpDomainName($testIPv4);
        $this->assertContains('<p style="color:green; font-weight: 900;">' . gethostbyaddr($testIPv4) .'</p>', $res2);
    }

    /**
     * Test the route "index".
     */
    public function testTheReturnedDomainIsNegative()
    {
        $test = "1.1.1.1.1.1";
        $res1 = $this->controller->getTheIpDomainName($test);
        $this->assertContains('<p style="color:red; font-weight: 900;">The ip-address you '.
        'have entered is not valid! </p>', $res1);
    }
}
