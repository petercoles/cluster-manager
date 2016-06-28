<?php

namespace PeterColes\Cluster\Test;

use Mockery as m;
use PeterColes\Cluster\Servers\Server;
use PeterColes\Cluster\Servers\Adapters\DigitalOcean;
use PeterColes\Cluster\HttpClients\GuzzleHttp;

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
