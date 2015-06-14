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
     *
     * @return null
     */
    public function setClient($client)
    {
        $this->client = $client;
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
