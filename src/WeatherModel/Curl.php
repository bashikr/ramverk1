<?php

namespace Bashar\WeatherModel;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Curl
{
    /**
     * Gets the Geo Location info in
     * Gets the Geo Location info in
     * an array
     *
     */
    public function getData(String $weatherApi)
    {
        // create & initialize a curl session
        $curl = curl_init($weatherApi);

        // set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, $weatherApi);

        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);

        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);

        $apiResult = json_decode($output, true);
        return $apiResult;
    }


    /**
     * Function that uses multiple curls and returns response
     *
     * @param array $urls API URLs to use in curls
     *
     * @return array $res Result in JSON
     */
    public function getDataArray(Array $urls)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        // Add all curl handlers and remember them
        // Initiate the multi curl handler
        $mh = curl_multi_init();
        $chAll = [];
        foreach ($urls as $url) {
            $ch = curl_init("$url");
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
        }

        // Execute all queries simultaneously,
        // and continue when all are complete
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        // Close the handles
        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);

        // All of our requests are done, we can now access the results
        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }
        return $response;
    }
}
