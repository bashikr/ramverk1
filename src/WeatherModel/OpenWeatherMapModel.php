<?php

namespace Bashar\WeatherModel;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class OpenWeatherMapModel implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string
     */
    private $message = "127.0.0.1";
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
    public function setMessage($message) : void
    {
        $this->message = $message;
    }


    /**
     * Sets the api from the config file
     * into the controller.
     *
     */
    public function setGeoApi($enteredIp, $geoApi) : void
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
    public function setWeatherApi5PreviousDays($geoUrlLat, $geoUrlLon) : void
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
    public function setWeatherApiNext10Days($geoUrlLat, $geoUrlLon) : void
    {
        $options = '&exclude=current,minutely,hourly,alerts&units=metric&lang=en';
        $baseUrl = 'https://api.openweathermap.org/data/2.5/onecall?';

        $this->weatherApiNext = $baseUrl . 'lat=' . $geoUrlLat . '&lon=' .
            $geoUrlLon . $options .  '&appid=' . $this->message;
    }


        /**
     * a json format
     *
     */
    public function getWeatherInJson($weatherApi)
    {
        $encoded = json_encode($weatherApi, true);
        $pattern1 = "/\"{/i";
        $first = preg_replace($pattern1, "{", $encoded);
        $pattern2 = "/[\]]$/i";
        $second = preg_replace($pattern2, "<br>]", $first);
        $pattern3 = "/,/i";
        $third = preg_replace($pattern3, ",<br>********", $second);
        $pattern4 = "/{/i";
        $fourth = preg_replace($pattern4, "{<br>********", $third);
        $pattern5 = "/}/i";
        $fifth = preg_replace($pattern5, "<br>****}", $fourth);
        $pattern6 = "/[\\\\]/i";
        $sixth = preg_replace($pattern6, "", $fifth);
        $string = str_replace("*", "&nbsp", $sixth);

        return $string;
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
}
