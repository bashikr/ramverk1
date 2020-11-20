<?php

namespace Bashar\IpValidator;

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
class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string
     */
    private $enteredIp;
    private $ipValidatorClass;

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
        $this->enteredIp = $request->getPost("ip");
        $this->ipValidatorClass = new IpValidator();
        $ipValidationResult = $this->ipValidatorClass->validateIpInput($this->enteredIp);
        $hostName = $this->ipValidatorClass->getTheIpDomainName($this->enteredIp);

        $data = [
            "ipValidationResult" => $ipValidationResult,
            "hostName" => $hostName
        ];

        $page->add("ipValidate/index", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
