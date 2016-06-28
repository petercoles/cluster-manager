<?php

namespace PeterColes\Cluster\Test;

use Mockery as m;
use PeterColes\Cluster\Servers\Server;

class ServerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->adapter = m::mock('\PeterColes\Cluster\Servers\Adapters\DigitalOcean', ['token' => 'foo']);
        $this->adapter
            ->shouldReceive('getHeaders')->once()->andReturn('headers')
            ->shouldReceive('setClient')->once();

        $this->httpClient = m::mock('\PeterColes\Cluster\HttpClients\GuzzleHttp');
        $this->httpClient
            ->shouldReceive('initClient')->once()->andReturn('client');

        $this->server = new Server($this->adapter, $this->httpClient);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testReadListOfServers()
    {
        $this->adapter->shouldReceive('read')->andReturn('bar');

        $result = $this->server->read();

        $this->assertEquals('bar', $result);
    }

    public function testReadServer()
    {
        $this->adapter->shouldReceive('read')->with(123)->andReturn('bar');

        $result = $this->server->read(123);

        $this->assertEquals('bar', $result);
    }

    public function testCreateServer()
    {
        $this->adapter->shouldReceive('create')->with(['image' => 'foo'])->andReturn('bar');

        $result = $this->server->create(['image' => 'foo']);

        $this->assertEquals('bar', $result);
    }

    public function testDeleteServer()
    {
        $this->adapter->shouldReceive('delete')->with(123)->andReturn(204);

        $result = $this->server->delete(123);

        $this->assertEquals(204, $result);
    }

    public function testListOfImagesNoParams()
    {
        $this->adapter->shouldReceive('images')->andReturn('bar');

        $result = $this->server->images();

        $this->assertEquals('bar', $result);
    }

    public function testListOfImagesWithParams()
    {
        $this->adapter->shouldReceive('images')->with(['foo' => 'bar'])->andReturn('baz');

        $result = $this->server->images(['foo' => 'bar']);

        $this->assertEquals('baz', $result);
    }
}
