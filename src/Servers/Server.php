<?php

namespace Kuroi\Cluster\Servers;

use Kuroi\Cluster\Contracts\ServerAdapterInterface;
use Kuroi\Cluster\Contracts\HttpClientInterface;

class Server
{
    protected $adapter;

    /**
     * Constructor - receive server adapter, adapter api authentication and http client details.
     * Initialise the http client and make it available for use by the server adapter.
     *
     * @param ServerAdapterInterface $adapter
     * @param HttpClientInterface $client
     */
    public function __construct(ServerAdapterInterface $adapter, HttpClientInterface $client = null)
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
     * List details for an indexed server, or all servers if id is null.
     *
     * @param integer $id
     *
     * @return GuzzleResponse | array of GuzzleResponse objects
     */
    public function read($id = null)
    {
        return $this->adapter->read($id);
    }

    /**
     * Create a new server based on parameters received.
     *
     * @param array $params
     *
     * @return array
     */
    public function create($params)
    {
        return $this->adapter->create($params);
    }

    /**
     * Delete the server corresponding to the given id.
     *
     * @param integer $id
     *
     * @return integer
     */
    public function delete($id)
    {
        return $this->adapter->delete($id);
    }

    /**
     * List available server images.
     *
     * @param array $params     list of qualifiers to filter the response
     *
     * @return array
     */
    public function images($params = [])
    {
        return $this->adapter->images($params);
    }
}
