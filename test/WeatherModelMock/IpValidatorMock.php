<?php
namespace Bashar\WeatherModel;

/**
 * Test the SampleController.
 */
class IpValidatorMock extends IpValidator
{



    protected function validateIpInput($enteredIp)
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
