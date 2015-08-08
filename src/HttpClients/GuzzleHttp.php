<?php

namespace Kuroi\Cluster\HttpClients;

use Kuroi\Cluster\Contracts\HttpClientInterface;
use GuzzleHttp\Client;
use Exception;

class GuzzleHttp implements HttpClientInterface
{
    public $request;

    /**
     * Initialise Guzzle client using headers appropriate to adapter.
     *
     * @param array $headers
     * @return void
     */
    public function initClient($headers)
    {
        try {
            $this->request = new Client($headers);
        } catch (Exception $e) {
            echo 'Unable to initialise http client because '.$e->getMessage()."\n";
        }
    }

    /**
     * Get status code from http response.
     *
     * @param GuzzleResponse $response
     * @return integer
     */
    public function getStatus($response)
    {
        return (int) $response->getStatusCode();
    }

    /**
     * Get http response body, cast to json and decode.
     *
     * @param GuzzleHttp\Response object $response
     * @return array
     */
    public function getBody($response)
    {
        return json_decode((string) $response->getBody());
    }
}
