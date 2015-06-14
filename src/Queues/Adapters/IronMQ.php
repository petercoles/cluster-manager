<?php

namespace Kuroi\Cluster\Queues\Adapters;

use Exception;
use Kuroi\Cluster\Contracts\Adapter;
use Kuroi\Cluster\Contracts\QueueAdapterInterface;

class IronMQ extends Adapter implements QueueAdapterInterface
{
    /**
     * The endpoint for all API calls to Digital Ocean (currently at v2)
     */
    // @todo support for all regions
    protected $apiEndpoint = 'https://mq-aws-us-east-1.iron.io/1';

    /**
     * List details for an indexed server, or all servers if id is null.
     *
     * @param string $queue
     *
     * @return integer
     */
    public function count($queue)
    {
        // @todo remove hard-coded project
        $response = $this->client->request->get(
            $this->apiEndpoint.'/projects/'.$this->params['project'].'/queues/'.$queue
        );

        return $this->client->getBody($response);
    }

    /**
     * Initialise http client.
     *
     * @return null
     */
    public function setHeaders()
    {
        $this->headers = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'OAuth ' . $this->params['token']
            ]
        ];
    }
}
