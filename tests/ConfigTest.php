<?php

namespace Kuroi\Cluster\Test;

use Kuroi\Cluster\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testUnsetKey()
    {
        $config = new Config();
        
        $this->assertFalse($config->has('key'));
        $this->assertNull($config->get('key'));
    }

    public function testSetKey()
    {
        $config = new Config();
        $config->set('key', 'value');

        $this->assertTrue($config->has('key'));
        $this->assertEquals('value', $config->get('key'));
    }
}
