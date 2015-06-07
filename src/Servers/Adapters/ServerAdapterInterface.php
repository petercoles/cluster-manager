<?php

namespace Kuroi\Cluster\Servers\Adapters;

interface ServerAdapterInterface
{
    public function read($id);

    public function create($params);

    public function delete($id);
}
