<?php

namespace Bashar\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Bashar\GeoLocationModel\GeoLocationByIpModel;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonGeoLocationByIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string
     */
    private $enteredIp;
    private $geoLocationByIpModel;
    private $getIpAddress;


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
        $title = "IP validator";
        $page = $this->di->get("page");
        $request = $this->di->get("request");

        $this->enteredIp = $request->getGet("ip");
        $enteredIp = $this->enteredIp;

        $this->ipValidatorClass = new IpValidator();
        $ipValidationResult = $this->ipValidatorClass->validateIpInput($this->enteredIp);
        $hostName = $this->ipValidatorClass->getTheIpDomainName($this->enteredIp);

        $this->geoLocationByIpModel = $this->di->get("ipstackcfg");
        $getIpAddress = $_SERVER['REMOTE_ADDR'] ?? "127.0.0.1";
        $this->getIpAddress = $getIpAddress;

        $this->geoLocationByIpModel->getGeoLocationNormal($this->enteredIp);
        $geoLocModRes = $this->geoLocationByIpModel->getGeoLocationJson();

        $data = [
            "getIpAddress" => $getIpAddress,
            "geoLocModRes" => $geoLocModRes,
            "hostName" => $hostName,
            "enteredIp" => $enteredIp,
            "ipValidationResult" => $ipValidationResult
        ];

        $page->add("ipValidate/JsonResponseGeoLocation", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
