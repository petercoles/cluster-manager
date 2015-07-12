<?php

namespace Kuroi\Cluster\Contracts;

abstract class Adapter
{
    /**
     * Params used to initialise this instance, e.g. authentication parameters for the Digital Ocean API.
     */
    protected $params;

    /**
     * The http client that will manage API requests and handle responses.
     */
    protected $client;

    /**
     * The headers to proceed the API request in order to authenticate it.
     */
    protected $headers;

    /**
     * Constructor. Receive and record parameters. Use them to set request headers.
     *
     * @param array $params
     */
    public function __construct($params)
    {
        $this->params = $params;

        $this->setHeaders();
    }

    /**
     * Set the client class var.
     *
     * @param GuzzleHttp\Client $client
     * @return void
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Construct http client request headers.
     *
     * @return void
     */
    protected function setHeaders()
    {
        $this->headers['headers']['Content-Type'] = 'application/json';
    }

    /**
     * Get headers for https client.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
