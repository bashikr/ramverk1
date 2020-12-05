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
                $res = 'The IP-address ' . '<p style="color:#69a542; font-weight: 900;">' . $enteredIp . '</p>' .
                ' is a valid IPv4 IP-address.' ;
                return $res;
            } elseif (filter_var($enteredIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $res = 'The IP-address ' . '<p style="color:#69a542; font-weight: 900;">' . $enteredIp . '</p>' .
                ' is a valid  IPv6 IP-address.' ;
                return $res;
            }
        }
        return 'The IP-address ' . '<p style="color:red; font-weight: 900;">' . $enteredIp .'</p>' . ' is not valid.';
    }

    /**
     * Check if IP is valid or not and then,
     * gets the domain name
     *
     * @return string
     */
    public function getTheIpDomainName($enteredIp)
    {
        if (filter_var($enteredIp, FILTER_VALIDATE_IP)) {
            $res = '<p style="color:green; font-weight: 900;">' . gethostbyaddr($enteredIp) .'</p>';
            return $res;
        }
        $res = '<p style="color:red; font-weight: 900;">The ip-address you have entered is not valid! </p>';
        return $res;
    }
}
