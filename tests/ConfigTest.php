<?php

namespace PeterColes\Cluster\Test;

use PeterColes\Cluster\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testUnsetKey()
    {
        $config = new Config;

        $this->assertFalse($config->has('key'));
        $this->assertNull($config->get('key'));
    }

    public function testSetKey()
    {
        $config = new Config;
        $config->set('key', 'value');

        $this->assertTrue($config->has('key'));
        $this->assertEquals('value', $config->get('key'));
    }

    public function testSetDuringInstantiation()
    {
        $config = new Config(['key' => 'value']);

        $this->assertTrue($config->has('key'));
        $this->assertEquals('value', $config->get('key'));
    }
}
