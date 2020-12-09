<?php
namespace Bashar\Weather;

use Bashar\WeatherModelMock\CurlMock;
use Bashar\WeatherModelMock\IpValidatorMock;
use Bashar\WeatherModelMock\OpenWeatherMapModelMock;
use Bashar\WeatherModelMock\GeoLocationByIpModelMock;

/**
 * Testclass.
 */
class WeatherIpControllerMock extends WeatherIpController
{
    public function initialize()
    {
        parent::initialize();

        $this->GeoLocationByIpModelMock = new GeoLocationByIpModelMock();
        $this->geoApiKeyMock = $this->GeoLocationByIpModelMock->getDetails();

        $this->openWeatherMapModelMock = new OpenWeatherMapModelMock();
        $this->openWeatherMapModelMock->getDetails();
        $this->openWeatherMapModelMock->setGeoApi($this->geoApiKeyMock = "83.233.138.94", "test");

        $this->curlMock = new CurlMock();

        $geoApiUrl = $this->openWeatherMapModelMock->getGeoApiUrl();
        $this->geoDataMock = $this->curlMock->getData($geoApiUrl);

        $this->ipValidatorClassMock = new IpValidatorMock();

        $this->ipValidationResultMock = $this->ipValidatorClassMock->validateIpInput($this->enteredIpMock);
    }


    public function indexAction() : object
    {
        return '{"test object"}';
    }

    public function previousAction() : object
    {
        return '{"test object previous"}';
    }

    public function nextAction() : object
    {
        return '{"test object next"}';
    }
}
