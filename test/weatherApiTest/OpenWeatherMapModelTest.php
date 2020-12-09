<?php

namespace Bashar\WeatherModel;

use Anax\DI\DIMagic;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class OpenWeatherMapModelTest extends TestCase
{

    protected $controller;
    protected $enteredIp;
    protected $geoApi;

    /**
     * Prepare before each test.
     */
    protected function setUp() : void
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices("config/di");

        // Setup OpenWeatherMapModel
        $this->controller = new OpenWeatherMapModel();
        // $this->controller->setDI($di);
    }

    /**
     * Test getDetails
     */
    public function testGetDetails()
    {
        $res =  $this->controller->getDetails();
        $this->assertStringContainsString("127.0.0.1", $res);
    }

    /**
     * Test setMessage
     */
    public function testSetMessage()
    {
        $this->controller->setMessage("test");
        $res =  $this->controller->getDetails();
        $this->assertStringContainsString("test", $res);
    }

    public function testSetGeoApi($enteredIp = "127.0.0.1", $geoApi = "test") : void
    {
        $this->geoApiUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';
        // $this->assertStringContainsString("test", $geoApi);
        $this->assertStringContainsString(
            'http://api.ipstack.com/127.0.0.1?access_key=test&hostname=1&security=1',
            $this->geoApiUrl
        );
    }


    public function testGetGeoApiUrl() : void
    {
        // global $di;

        // // Set the mock as a service into $di (overwrite the exiting service)
        // $di->setShared("ipstackcfg", "\Bashar\GeoLocationModel\GeoLocationByIpModel");
        // $di = $this->di;

        // Setup GeoLocationByIpModel
        $this->geoApi= new \Bashar\GeoLocationModel\GeoLocationByIpModel();
        // $this->geoApi->setDI($this->di);

        $this->geoApi->setMessage("test");
        $geoApi =  $this->geoApi->getDetails();
        
        
        $enteredIp = "127.0.0.1";
        $this->geoApiUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';
        // $this->assertStringContainsString("test", $geoApi);
        $this->assertStringContainsString(
            'http://api.ipstack.com/127.0.0.1?access_key=test&hostname=1&security=1',
            $this->geoApiUrl
        );
    }
}
