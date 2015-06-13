<?php

namespace Kuroi\Cluster\Servers\Adapters;

use Exception;
use Kuroi\Cluster\Contracts\ServerAdapterInterface;

class DigitalOcean implements ServerAdapterInterface
{
    /**
     * The endpoint for all API calls to Digital Ocean (currently at v2)
     */
    protected $apiEndpoint = 'https://api.digitalocean.com/v2';

    /**
     * The http client that will manage API requests and handle responses.
     */
    protected $client;

    /**
     * A set of default params for creating Digital Ocean droplets
     *
     * @todo add methods to make this more dynamic and controllable by consumers
     */
    protected $defaults = [
        "name" => "example.com",
        "region" => "lon1",
        "size" => "512mb",
        "image" => "ubuntu-14-04-x64",
        "ssh_keys" => null,
        "backups" => false,
        "ipv6" => true,
        "user_data" => null,
        "private_networking" => null
    ];

    /**
     * Set the client class var.
     *
     * @param array $client
     *
     * @return null
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * List details for an indexed server, or all servers if id is null.
     *
     * @param integer $id
     *
     * @return GuzzleResponse object | array of GuzzleResponse objects
     */
    public function read($id = null)
    {
        if ($id === null) {
            $response = $this->client->request->get($this->apiEndpoint . "/droplets");
        } else {
            $response = $this->client->request->get($this->apiEndpoint . "/droplets/$id");
        }

        return $this->client->getBody($response);
    }

    /**
     * Create a new server based on parameters received.
     *
     * @param array $params
     *
     * @return array
     */
    public function create($params = array())
    {
        $serverConfig = array_merge($this->defaults, $params);

        try {
            $response = $this->client->request->post($this->apiEndpoint . "/droplets", ['form_params' => $serverConfig]);

            if (202 != $this->client->getStatus($response)) {
                throw new Exception('Unable to create server.');
            }
        } catch (Exception $e) {
            echo 'Unable to create server because ' . $e->getMessage();
        }

        return $this->client->getBody($response);
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
        try {
            $response = $this->client->request->delete($this->apiEndpoint . "/droplets/$id");

            $status = $this->client->getStatus($response);

            if (204 != $status) {
                throw new Exception('Unable to delete server.');
            }
        } catch (Exception $e) {
            echo 'Unable to delete server because ' . $e->getMessage();
        }

        return $status;
    }

    /**
     * Initialise http client.
     *
     * @param array $authParams
     *
     * @return array
     */
    public function requestHeaders($authParams)
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $authParams['token']
            ]
        ];
    }
}
