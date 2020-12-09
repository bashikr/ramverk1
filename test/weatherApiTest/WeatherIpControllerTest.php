<?php
namespace Bashar\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class WeatherIpControllerTest extends TestCase
{
    protected $di;
    protected $weatherControllerMock;


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

        // Setup WeatherIpController
        $this->weatherControllerMock = new WeatherIpController();
        $this->weatherControllerMock->setDI($this->di);
        $this->weatherControllerMock->initialize();
    }

    /**
     * Test indexAction
     */
    public function testIndexAction()
    {
        $res = $this->weatherControllerMock->indexAction();
        $this->assertInternalType("object", $res);
    }


    /**
     * Test previousAction
     */
    public function testPreviousAction()
    {
        $res = $this->weatherControllerMock->previousAction();
        $this->assertInternalType("object", $res);
    }


    /**
     * Test nextAction
     */
    public function testNextAction()
    {
        $res = $this->weatherControllerMock->nextAction();
        $this->assertInternalType("object", $res);
    }
}
