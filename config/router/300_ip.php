<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP validator",
            "mount" => "ipValidate",
            "handler" => "\Bashar\IpValidator\IpValidatorController",
        ],
    ]
];
