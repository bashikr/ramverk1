<?php

namespace Bashar\Weather;

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
class WeatherIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string
     */
    private $enteredIp;
    private $geoApiKey;
    private $geoData;
    private $ipValidationResult;
    protected $getInfoPrevious;
    protected $getInfoNext;


    public function initialize()
    {
        $this->geoLocationModel = new \Bashar\GeoLocationModel\GeoLocationByIpModel();
        $this->geoLocationModel = $this->di->get("ipstackcfg");
        $this->geoApiKey = $this->geoLocationModel->getDetails();

        $this->openWeatherMapModel = new \Bashar\WeatherModel\OpenWeatherMapModel();
        $this->openWeatherMapModel = $this->di->get("openWeatherMap");

        $request = $this->di->get("request");
        $this->enteredIp = $request->getGet("ip") ?? null;

        $this->openWeatherMapModel->setGeoApi($this->enteredIp, $this->geoApiKey);
        
        $this->curl = $this->di->get("curl");

        $geoApiUrl = $this->openWeatherMapModel->getGeoApiUrl();
        $this->geoData = $this->curl->getData($geoApiUrl);

        $this->ipValidatorClass = new \Bashar\WeatherModel\IpValidator();

        $this->ipValidationResult = $this->ipValidatorClass->validateIpInput($this->enteredIp);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountPoint
     * ANY METHOD mountPoint/
     * ANY METHOD mountPoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $enteredIp = $this->enteredIp;
        $getIpAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        $ipValidationResult = $this->ipValidationResult;

        $data = [
            "getIpAddress" => $getIpAddress ?? null,
            "enteredIp" => $enteredIp ?? null,
            "ipValidationResult" => $ipValidationResult?? null
        ];

        $page->add("WeatherView/index", $data);
        return $page->render([
            "title" => "Weather landing",
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountPoint
     * ANY METHOD mountPoint/
     * ANY METHOD mountPoint/index
     *
     * @return string
     */
    public function previousAction() : object
    {
        $page = $this->di->get("page");
        $enteredIp = $this->enteredIp;
        $getIpAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        $geoData = $this->geoData;
        $lati = $geoData["latitude"] ?? null;
        $long = $geoData["longitude"] ?? null;

        $this->openWeatherMapModel->setWeatherApi5PreviousDays($lati, $long);
        $this->weatherUrlPrevious = $this->openWeatherMapModel->getWeatherApiPrevious();
        $weatherUrlPrevious = $this->weatherUrlPrevious;

        $this->getInfoPrevious = $this->curl->getDataArray($weatherUrlPrevious);
        $getInfoPrevious = $this->getInfoPrevious;
        
        $arrIconPrevious = [];
        $tempArrayPrevious= [];
        $dateArrayPrevious = [];
        $wrStatArrayPrev = [];

        if (is_array($getInfoPrevious) || is_object($getInfoPrevious)) {
            foreach ($getInfoPrevious as $value) {
                $weatherStatus = $value["current"]["weather"][0]["main"] ?? null;
                array_push($wrStatArrayPrev, $weatherStatus);

                $timezonePrevious = $value["timezone"] ?? null;
                $date = date("d/m", $value["hourly"][11]["dt"] ?? null);
                array_push($dateArrayPrevious, $date);

                array_push($tempArrayPrevious, round($value["current"]["temp"] ?? null, 0));

                $icon = $value["current"]["weather"][0]["icon"] ?? null;
                array_push($arrIconPrevious, $icon);
            }
        }

        $json = [
            "tempArrayPrevious" => $tempArrayPrevious ?? null,
            "dateArrayPrevious" => $dateArrayPrevious ?? null,
            "arrIconPrevious" => $arrIconPrevious ?? null,
            "weatherStatusArrayPrevious" => $wrStatArrayPrev ?? null,
            "timezonePrevious" => $timezonePrevious ?? null,
        ];

        $this->weatherInJson = $this->openWeatherMapModel->getWeatherInJson($json);
        $weatherInJson= $this->weatherInJson;

        $data = [
            "weatherInJson" => $weatherInJson ?? null,
            "geoData" => $geoData ?? null,
            "getIpAddress" => $getIpAddress ?? null,
            "enteredIp" => $enteredIp ?? null,
            "tempArrayPrevious" => $tempArrayPrevious ?? null,
            "dateArrayPrevious" => $dateArrayPrevious ?? null,
            "arrIconPrevious" => $arrIconPrevious ?? null,
            "weatherStatusArrayPrevious" => $wrStatArrayPrev ?? null,
            "timezonePrevious" => $timezonePrevious ?? null,
        ];

        $page->add("WeatherView/previous", $data);
        return $page->render([
            "title" => "Weather history",
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountPoint
     * ANY METHOD mountPoint/
     * ANY METHOD mountPoint/index
     *
     * @return string
     */
    public function nextAction() : object
    {
        $page = $this->di->get("page");
        $enteredIp = $this->enteredIp;
        $getIpAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        $geoData = $this->geoData;
        $lati = $geoData["latitude"] ?? null;
        $long = $geoData["longitude"] ?? null;
        $ipValidationResult = $this->ipValidationResult;

        $this->openWeatherMapModel->setWeatherApiNext10Days($lati, $long);
        $this->weatherUrlNext = $this->openWeatherMapModel->getWeatherApiNext();
        $weatherUrlNext = $this->weatherUrlNext;

        $this->getInfoNext = $this->curl->getData($weatherUrlNext);
        $getInfoNext = $this->getInfoNext;


        $arrIconNext = [];
        $tempArrayNext= [];
        $dateArrayNext = [];
        $wrStatusArrayNext = [];
        $timezoneNext = $getInfoNext["timezone"] ?? null;
        $getInfoDaily = $getInfoNext["daily"] ?? null;

        if (is_array($getInfoDaily) || is_object($getInfoDaily)) {
            foreach ($getInfoDaily as $value1) {
                $weatherStatus = $value1["weather"][0]["main"] ?? null;
                array_push($wrStatusArrayNext, $weatherStatus);

                $date = date("d/m", $value1["dt"] ?? null);
                array_push($dateArrayNext, $date);

                $icon = $value1["weather"][0]["icon"] ?? null;
                array_push($arrIconNext, $icon);

                array_push($tempArrayNext, round($value1["temp"]["day"] ?? null, 0));
            }
        }

        $json = [
            "tempArrayNext" => $tempArrayNext ?? null,
            "dateArrayNext" => $dateArrayNext ?? null,
            "arrIconNext" => $arrIconNext?? null,
            "weatherStatusArrayNext" => $wrStatusArrayNext?? null,
            "timezoneNext" => $timezoneNext?? null,
        ];

        $this->weatherInJson = $this->openWeatherMapModel->getWeatherInJson($json);
        $weatherInJson= $this->weatherInJson;

        $data = [
            "weatherInJson" => $weatherInJson ?? null,
            "geoData" => $geoData ?? null,
            "getIpAddress" => $getIpAddress ?? null,
            "enteredIp" => $enteredIp ?? null,
            "tempArrayNext" => $tempArrayNext ?? null,
            "dateArrayNext" => $dateArrayNext ?? null,
            "arrIconNext" => $arrIconNext?? null,
            "weatherStatusArrayNext" => $wrStatusArrayNext?? null,
            "timezoneNext" => $timezoneNext?? null,
            "ipValidationResult" => $ipValidationResult?? null
        ];

        $page->add("WeatherView/next", $data);
        return $page->render([
            "title" => "Weather forecast",
        ]);
    }
}
