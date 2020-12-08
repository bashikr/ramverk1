<?php

namespace Bashar\GeoLocationModel;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class GeoLocationByIpModelTest extends TestCase
{

    protected $di;
    protected $getLocationControllerMock;


    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;

        // Setup GeoLocationByIpModel
        $this->getLocationControllerMock = new GeoLocationByIpModel();
        $this->getLocationControllerMock->setDI($this->di);
    }


    /**
     * returns the api from the config file "ipstackcfg"
     *
     */
    public function testGetGeoApi()
    {
        $this->getLocationControllerMock->setMessage("test");
        $this->getLocationControllerMock->setGeoApi("83.233.138.94");
        $res = $this->getLocationControllerMock->getGeoApi();

        $this->assertInternalType("string", $res);
    }


    /**
     * Gets the Geo Location info in
     * Gets the Geo Location info in
     * an array
     *
     */
    public function testDoCurl()
    {
        $res = $this->getLocationControllerMock->doCurl("string response");
        $this->assertInternalType("string", $res);
    }


    /**
     * a json format
     *
     */
    public function testGetGeoLocationJson()
    {
        $res = $this->getLocationControllerMock->getGeoLocationJson("83.233.138.94");
        $this->assertInternalType("string", $res);
    }


    /**
     * Gets the Geo Location info in
     * an array
     *
     */
    public function testGetGeoLocationNormal()
    {
        $res = $this->getLocationControllerMock->getGeoLocationNormal("83.233.138.94");
        $this->assertInternalType("array", $res);
    }
}
