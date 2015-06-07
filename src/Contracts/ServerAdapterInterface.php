<?php

namespace Kuroi\Cluster\Contracts;

interface ServerAdapterInterface
{
    public function read($id);

    public function create($params);

    public function delete($id);
}