<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP validator with json response",
            "mount" => "ipToJson",
            "handler" => "\Bashar\IpValidator\JsonIpValidatorController",
        ],
    ]
];
