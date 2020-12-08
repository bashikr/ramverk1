<?php
namespace Bashar\WeatherModel;

/**
 * Testclass.
 */
class OpenWeatherMapModelMock extends OpenWeatherMapModel
{

    /**
     * @var string
     */
    private $message = "test";
    private $weatherApiPrevious = [];
    private $weatherApiNext;

    /**
     * returns the api from the config file "ipstackcfg"
     *
     */
    public function getDetails() : string
    {
        return $this->message;
    }

    /**
     * Sets the api from the config file
     * into the controller.
     *
     */
    public function setGeoApi($enteredIp = "83.233.138.94", $geoApi = "test") : void
    {
        $this->geoApiUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';
    }


    /**
     * returns the api from the config file "ipstackcfg"
     *
     */
    public function getGeoApiUrl()
    {
        return $this->geoApiUrl;
    }


    /**
     * Sets the api from the config file
     * into the controller.
     *
     */
    public function setWeatherApi5PreviousDays($geoUrlLat = "56.0467", $geoUrlLon = "12.6944") : void
    {
        $options = '&exclude=minutely,hourly,alerts&units=metric&lang=en';
        $baseUrl = 'http://api.openweathermap.org/data/2.5/onecall/timemachine?';
        for ($i = -5; $i <= -1; $i++) {
            $datePrevious = strtotime("$i days");
            array_push($this->weatherApiPrevious, $baseUrl . 'lat=' . $geoUrlLat . '&lon=' .
                $geoUrlLon . '&dt=' . $datePrevious . $options . '&appid=' . $this->message);
        }
    }


    /**
     * Sets the api from the config file
     * into the controller.
     *
     */
    public function setWeatherApiNext10Days($geoUrlLat = "56.0467", $geoUrlLon = "12.6944") : void
    {
        $options = '&exclude=current,minutely,hourly,alerts&units=metric&lang=en';
        $baseUrl = 'https://api.openweathermap.org/data/2.5/onecall?';

        $this->weatherApiNext = $baseUrl . 'lat=' . $geoUrlLat . '&lon=' .
            $geoUrlLon . $options .  '&appid=' . $this->message;
    }

    
    /**
     * returns the api from the config file "openWeatherMap"
     *
     */
    public function getWeatherApiPrevious()
    {
        return $this->weatherApiPrevious;
    }
    
    /**
     * returns the api from the config file "openWeatherMap"
     *
     */
    public function getWeatherApiNext()
    {
        return $this->weatherApiNext;
    }

        /**
     * a json format
     *
     */
    public function getWeatherInJson($weatherApi)
    {
        $weatherApi = "test";
        return $weatherApi;
    }
}
