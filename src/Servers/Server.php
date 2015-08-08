<?php

namespace Kuroi\Cluster\Servers;

use Kuroi\Cluster\Contracts\Factory;
use Kuroi\Cluster\Contracts\ServerAdapterInterface;
use Kuroi\Cluster\Contracts\HttpClientInterface;

class Server extends Factory
{
    /**
     * Constructor - receive server adapter, adapter api authentication and http client details.
     * Initialise the http client and make it available for use by the server adapter.
     *
     * @param ServerAdapterInterface $adapter
     * @param HttpClientInterface $client
     */
    public function __construct(ServerAdapterInterface $adapter, HttpClientInterface $client = null)
    {
        $this->init($adapter, $client);
    }

    /**
     * List details for an indexed server, or all servers if id is null.
     *
     * @param integer $id
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
     * @return array
     */
    public function images($params = [])
    {
        return $this->adapter->images($params);
    }
}
