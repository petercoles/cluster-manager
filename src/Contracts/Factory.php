<?php

namespace Kuroi\Cluster\Contracts;

abstract class Factory
{
    /**
     * The adapter being constructed by the factory
     */
    protected $adapter;

    /**
     * Initialise the adapter, including injecting an http client
     *
     * @param object $adapter
     * @param object $client
     */
    public function init($adapter, $client = null)
    {
        // set the server adapter
        $this->adapter = $adapter;

        // for ease of use we can fallback to a default http client
        if (!$client) {
            $client = new \Kuroi\Cluster\HttpClients\GuzzleHttp;
        }

        // initialise the http client with the authentication header options
        $client->initClient($this->adapter->getHeaders());

        // make the initialised http client available to the adapter
        $this->adapter->setClient($client);
    }
}
