<?php

namespace Kuroi\Cluster\Queues;

use Kuroi\Cluster\Contracts\QueueAdapterInterface;
use Kuroi\Cluster\Contracts\HttpClientInterface;

class Queue
{
    protected $adapter;

    /**
     * Constructor - receive server adapter, adapter api authentication and http client details.
     * Initialise the http client and make it available for use by the server adapter.
     *
     * @param QueueAdapterInterface $adapter
     * @param HttpClientInterface $client
     */
    public function __construct(QueueAdapterInterface $adapter, HttpClientInterface $client = null)
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

    /**
     * Receives the name of a queue and returns the number of jobs in that queue.
     *
     * @param string $queue
     *
     * @return integer
     */
    public function count($queue)
    {
        return $this->adapter->count($queue);
    }
}
