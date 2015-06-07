<?php

namespace Kuroi\Cluster\Test;

use Mockery as m;
use Kuroi\Cluster\Servers\Server;
use Kuroi\Cluster\Servers\Adapters\DigitalOcean;
use Kuroi\Cluster\HttpClients\GuzzleHttp;

class DigitalOceanTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }

    public function tearDown()
    {
        m::close();
    }

    public function testReadListOfDroplets()
    {

    }

    public function testReadDroplet()
    {

    }

    public function testCreateDroplet()
    {

    }

    public function testDeleteDroplet()
    {

    }
}
