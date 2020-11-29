<?php

namespace Bashar\WeatherModel;

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

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Set the mock as a service into $di (overwrite the exiting service)
        $di->setShared("openWeatherMap", "\Bashar\WeatherModel\Curl");
        $di = $this->di;

        // Setup OpenWeatherMapModel
        $this->curl = new Curl();
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
