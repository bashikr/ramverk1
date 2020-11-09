<?php

namespace Bashar\IpValidator;

use Anax\DI\DIMagic;
use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test features for THE controller IpValidatorController.
 */
class IpValidatorControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp() : void
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di = new DIMagic();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di = $this->di;

        // Setup IpValidatorController
        $this->controller = new IpValidatorController();
        $this->controller->setDI($this->di);
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInternalType("object", $res);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
