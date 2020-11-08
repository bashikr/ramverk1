<?php

namespace Bashar\IpValidator;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test features for THE controller IpValidatorController.
 */
class JsonIpValidatorControllerTest extends TestCase
{
    public function setUp() : void
    {
        $di = new DIMagic();
        $di->loadServices("config/di");

        $this->controller = new JsonIpValidatorController();
        $this->controller->setDi($di);
    }

    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
