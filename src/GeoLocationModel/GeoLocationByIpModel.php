<?php

namespace Bashar\GeoLocationModel;

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
class GeoLocationByIpModel implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string
     */
    private $message = "127.0.0.1";
    private $apiResult;
    private $geoApi;


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
    public function setGeoApi($enteredIp) : void
    {
        $this->geoApi = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $this->message .
        '&hostname=1&security=1';
    }


    /**
     * returns the api from the config file "ipstackcfg"
     *
     */
    public function getGeoApi()
    {
        return $this->geoApi;
    }


    /**
     * Gets the Geo Location info in
     * Gets the Geo Location info in
     * an array
     *
     */
    public function doCurl($geoApi) : string
    {
        // create & initialize a curl session
        $curl = curl_init();

        // set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, $geoApi);

        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);

        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);

        return $output;
    }


    /**
     * a json format
     *
     */
    public function getGeoLocationJson()
    {
        $encoded = json_encode($this->apiResult, true);
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
     * Gets the Geo Location info in
     * an array
     *
     */
    public function getGeoLocationNormal($enteredIp)
    {
        $this->setGeoApi($enteredIp);
        $output = $this->doCurl($this->geoApi);

        $apiResult = json_decode($output, true);
        $this->apiResult = $apiResult;
        return $this->apiResult;
    }
}
