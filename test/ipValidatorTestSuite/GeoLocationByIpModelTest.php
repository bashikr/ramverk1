<?php

namespace Bashar\GeoLocationModel;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class GeoLocationByIpModelTest extends TestCase
{

    protected $controller;
    protected $enteredIp;

    /**
     * Prepare before each test.
     */
    protected function setUp() : void
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Set the mock as a service into $di (overwrite the exiting service)
        $di->setShared("ipstackcfg", "\Bashar\GeoLocationModel\GeoLocationByIpModel");
        $di = $this->di;

        // Setup GeoLocationByIpModel
        $this->controller = new GeoLocationByIpModel();
        $this->controller->setDI($this->di);
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

    /**
     * Test getGeoLocationNormal()
     */
    public function testGetGeoLocationNormal()
    {
        $res =  $this->controller->getGeoLocationNormal("100.47.150.9");
        $this->assertInternalType("array", $res);
    }

    /**
     * Test  getGeoLocationJson()
     */
    public function testGetGeoLocationJson()
    {
        $res =  $this->controller->getGeoLocationJson();
        $this->assertInternalType("string", $res);
    }
}
