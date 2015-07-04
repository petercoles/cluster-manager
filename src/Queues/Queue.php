<?php

namespace Kuroi\Cluster\Queues;

use Kuroi\Cluster\Contracts\Factory;
use Kuroi\Cluster\Contracts\QueueAdapterInterface;
use Kuroi\Cluster\Contracts\HttpClientInterface;

class Queue extends Factory
{
    /**
     * Constructor - receive server adapter, adapter api authentication and http client details.
     * Initialise the http client and make it available for use by the server adapter.
     *
     * @param QueueAdapterInterface $adapter
     * @param HttpClientInterface $client
     */
    public function __construct(QueueAdapterInterface $adapter, HttpClientInterface $client = null)
    {
        $this->init($adapter, $client);
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
