<?php

namespace PeterColes\Cluster\Contracts;

interface HttpClientInterface
{
    public function initClient($headers);

    public function getStatus($response);

    public function getBody($repsonse);
}
