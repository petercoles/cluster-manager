<?php

namespace PeterColes\Cluster\Contracts;

interface QueueAdapterInterface
{
    public function count($queue);

    public function clear($queue);
}
