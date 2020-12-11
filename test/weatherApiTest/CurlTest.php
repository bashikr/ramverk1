<?php

namespace Bashar\WeatherModel;

use Anax\DI\DIMagic;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class CurlTest extends TestCase
{
    protected $curl;
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

        $this->curl = new Curl();
        // $this->curl->setDi($di);
    }


    /**
     * Test setMessage
     */
    public function testGetData()
    {
        $enteredIp = "100.47.150.9";
        $geoApi = "test";
        $geoUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';
        $getData = $this->curl->getData($geoUrl);

        $this->assertInternalType("array", $getData);
    }


        /**
     * Test setMessage
     */
    public function testGetDataArray()
    {
        $enteredIp = "100.47.150.9";
        $geoApi = "test";
        $geoUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';

        $geoUrlArray = [
            "url1" => $geoUrl,
            "url2" => $geoUrl,
            "url3" => $geoUrl,
        ];

        $getDataArray = $this->curl->getDataArray($geoUrlArray);

        $this->assertInternalType("array", $getDataArray);
    }
}
