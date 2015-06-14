<?php

namespace Kuroi\Cluster\Test;

use Mockery as m;
use Kuroi\Cluster\Servers\Server;

class ServerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->adapter = m::mock('\Kuroi\Cluster\Servers\Adapters\DigitalOcean', ['token' => 'foo']);
        $this->adapter
            ->shouldReceive('getHeaders')->once()->andReturn('headers')
            ->shouldReceive('setClient')->once();

        $this->client = m::mock('\Kuroi\Cluster\HttpClients\GuzzleHttp');
        $this->client
            ->shouldReceive('initClient')->once()->andReturn('client');

        $this->server = new Server($this->adapter, $this->client);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testReadListOfDroplets()
    {
        $this->adapter->shouldReceive('read')->andReturn('bar');

        $result = $this->server->read();

        $this->assertEquals('bar', $result);
    }

    public function testReadDroplet()
    {
        $this->adapter->shouldReceive('read')->with(123)->andReturn('bar');

        $result = $this->server->read(123);

        $this->assertEquals('bar', $result);
    }

    public function testCreateDroplet()
    {
        $this->adapter->shouldReceive('create')->with(['image' => 'foo'])->andReturn('bar');

        $result = $this->server->create(['image' => 'foo']);

        $this->assertEquals('bar', $result);
    }

    public function testDeleteDroplet()
    {
        $this->adapter->shouldReceive('delete')->with(123)->andReturn(204);

        $result = $this->server->delete(123);

        $this->assertEquals(204, $result);
    }
}
