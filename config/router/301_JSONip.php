<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP validator with json response",
            "mount" => "json-ip",
            "handler" => "\Bashar\IpValidator\JsonIpValidatorController1",
        ],
    ]
];
