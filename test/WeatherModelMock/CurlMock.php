<?php
namespace Bashar\WeatherModel;

/**
 * Testclass.
 */
class CurlMock extends Curl
{

    protected function getData(string $url) : string
    {
        $data = [];
        $data["/1"] = <<<EOD
        {
            "id": 1,
            "firstName": "Phuong",
            "lastName": "Allison"
        }
        EOD;

        $data["/2"] = <<<EOD
        {
            "id": 2,
            "firstName": "Marie",
            "lastName": "Collinsworth"
        }
        EOD;

        $data["/3"] = <<<EOD
        {
            "id": 3,
            "firstName": "Simon",
            "lastName": "Uzzle"
        }
        EOD;

        return $data[$url];
    }

    protected function getDataArray(Array $urls) : array
    {
        $data = [];
        $data["/1"] = <<<EOD
        {
            "id": 1,
            "firstName": "Phuong",
            "lastName": "Allison"
        }
        EOD;

        $data["/2"] = <<<EOD
        {
            "id": 2,
            "firstName": "Marie",
            "lastName": "Collinsworth"
        }
        EOD;

        $data["/3"] = <<<EOD
        {
            "id": 3,
            "firstName": "Simon",
            "lastName": "Uzzle"
        }
        EOD;

        return $data[$urls];
    }
}
