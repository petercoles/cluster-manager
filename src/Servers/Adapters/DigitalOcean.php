<?php

namespace Kuroi\Cluster\Servers\Adapters;

use Exception;
use Kuroi\Cluster\Contracts\Adapter;
use Kuroi\Cluster\Contracts\ServerAdapterInterface;

class DigitalOcean extends Adapter implements ServerAdapterInterface
{
    /**
     * The endpoint for all API calls to Digital Ocean (currently at v2)
     */
    protected $apiEndpoint = 'https://api.digitalocean.com/v2';

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
     * List details for an indexed server, or all servers if id is null.
     *
     * @param integer $id
     *
     * @return GuzzleResponse object | array of GuzzleResponse objects
     */
    public function read($id = null)
    {
        if ($id === null) {
            $response = $this->client->request->get($this->apiEndpoint."/droplets");
        } else {
            $response = $this->client->request->get($this->apiEndpoint."/droplets/$id");
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
            $response = $this->client->request->post($this->apiEndpoint."/droplets", ['form_params' => $serverConfig]);

            if (202 != $this->client->getStatus($response)) {
                throw new Exception('Unable to create server.');
            }
        } catch (Exception $e) {
            echo 'Unable to create server because '.$e->getMessage();
        }

        return $this->client->getBody($response);
    }

    /**
     * Delete the server corresponding to the given id.
     *
     * @param integer $id
     *
     * @return integer | null
     */
    public function delete($id)
    {
        try {
            $response = $this->client->request->delete($this->apiEndpoint."/droplets/$id");

            $status = $this->client->getStatus($response);

            if (204 != $status) {
                throw new Exception('Digital Ocean responded that it could not delete it.');
            }

            return $status;

        } catch (Exception $e) {
            echo 'Unable to delete server because '.$e->getMessage();
        }
    }

    /**
     * List of available snapshots.
     *
     * @param array $params
     *
     * @return array
     */
    public function images($params)
    {
        try {
            $response = $this->client->request->get($this->apiEndpoint.'/images'.$this->paramsToString($params));

            $status = $this->client->getStatus($response);

            if (200 != $status) {
                throw new Exception('Digital Ocean was not able to successfully provide a list of snapshots.');
            }

            return $this->client->getBody($response);

        } catch (Exception $e) {
            echo 'Unable to list snapshots because '.$e->getMessage();
        }
    }

    /**
     * Construct http client request headers.
     *
     * @return null
     */
    private function setHeaders()
    {
        parent::setHeaders();

        $this->headers['headers']['Authorization'] = 'Bearer ' . $this->params['token'];
    }

    /**
     * Construct http client request headers.
     * @todo this isn't the best place for it - see where it gets used next and find it a better home
     *
     * @param Array | null  $in   array of parameters to be converted to string for URL
     *
     * @return String
     */
    private function paramsToString($in)
    {
        $out = http_build_query((array) $in);

        return strlen($out) > 0 ? '?'.$out : '';
    }
}
