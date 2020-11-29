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
class IpValidator implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Check if IP is valid or not.
     * GET  domain
     *
     */
    public function validateIpInput($enteredIp)
    {
        if (filter_var($enteredIp, FILTER_VALIDATE_IP)) {
            if (filter_var($enteredIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return true;
            } elseif (filter_var($enteredIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                return false;
            }
        }
        return false;
    }
}
