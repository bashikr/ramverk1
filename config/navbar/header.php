<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",
 
    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
        [
            "text" => "IP",
            "url" => "ip-validate",
            "title" => "Tjänst för validering av IP-adresser",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Ip validator with text response",
                        "url" => "ip-validate",
                        "title" => "Ip validator with text response",
                    ],
                    [
                        "text" => "Ip validator with JSON response",
                        "url" => "ip-to-json",
                        "title" => "Ip validator with JSON response",
                    ],
                ],
            ],
        ],
        [
            "text" => "GEO IP",
            "url" => "geo-ip-normal",
            "title" => "A service for presentation of Geo Location via IP-address",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Geo Location with text response",
                        "url" => "geo-ip-normal",
                        "title" => "Geo Location with text response",
                    ],
                    [
                        "text" => "Geo Location with JSON response",
                        "url" => "geo-ip-json",
                        "title" => "Ip validator with JSON response",
                    ],
                ],
            ],
        ],
    ],
];
