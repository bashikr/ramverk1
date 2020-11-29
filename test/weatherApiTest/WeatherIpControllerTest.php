<?php

namespace Bashar\IpValidator\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;

/**
 * Testclass.
 */
class WeatherIpControllerTest extends TestCase
{

    protected $weatherController;
    protected $enteredIp;
    protected $geoApi;

    /**
     * Prepare before each test.
     */
    protected function setUp() : void
    {
        // Init service container $di to contain $app as a service
        global $di;
        global $weatherController;

        $this->di = new DIMagic();

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");


        // Setup WeatherIpController
        $this->weatherController = new \Bashar\IpValidator\Weather\WeatherIpController();
        $this->weatherController->setDI($this->di);
        $this->weatherController->initialize();
    }


    /**
     * Test setMessage
     */
    public function testIndexAction()
    {
        $res = $this->weatherController->indexAction();
        $this->assertInternalType("object", $res);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test setMessage
     */
    public function testPreviousAction()
    {
        global $di;

        $request = $di->get("request");
        $request->setGet("ip", "100.47.150.9");

        $res = $this->weatherController->previousAction();

        $this->assertInternalType("object", $res);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Test setMessage
     */
    public function testNextAction()
    {
        global $di;

        $request = $di->get("request");
        $request->setGet("ip", "100.47.150.9");

        $res = $this->weatherController->nextAction();

        $this->assertInternalType("object", $res);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
