<?php

namespace Bashar\IpValidator;

use Anax\DI\DIMagic;
use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test features for THE controller IpValidatorController.
 */
class JsonIpValidatorControllerTest extends TestCase
{
    protected $controller;
    protected $ipValidatorClass;
    protected $enteredIp;

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
        $this->controller = new JsonIpValidatorController();
        $this->ipValidatorClass = new IpValidator();
        $this->enteredIp = "127.0.0.1";
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

    /**
     * Test the route "ip-to-json".
     */
    public function testIpToJson()
    {
        $res = $this->controller->ipToJson($this->enteredIp, $this->ipValidatorClass);
        $this->assertInternalType("array", $res);
        $this->assertIsArray($res);
    }

    /**
     * Test the route "ip-to-json".
     */
    public function testPositiveIpToJsonResponse()
    {
        $res = $this->controller->ipToJson($this->enteredIp, $this->ipValidatorClass);
        $this->assertContains([
            "enteredIp" => $this->enteredIp,
            "ipValidationResult" => $this->ipValidatorClass->validateIpInput($this->enteredIp) ?? null,
            "hostName" => $this->ipValidatorClass->getTheIpDomainName($this->enteredIp) ?? null,
        ], $res);
    }

    /**
     * Test the route "ip-to-json".
     */
    public function testNegativeIpToJsonResponse()
    {
        $this->enteredIp = "127.0.0.f";
        $res = $this->controller->ipToJson($this->enteredIp, $this->ipValidatorClass);
        $this->assertNotContains([
            "enteredIp" => $this->enteredIp,
            "ipValidationResult" => $this->ipValidatorClass->validateIpInput($this->enteredIp) ?? null,
            "hostName" => "The ip-address you have entered is valid! ",
        ], $res);
    }
}
