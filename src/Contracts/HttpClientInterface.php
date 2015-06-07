<?php

namespace Kuroi\Cluster\Contracts;

interface HttpClientInterface
{
    public function initClient($params);

    public function getStatus($response);

    public function getBody($repsonse);
}
