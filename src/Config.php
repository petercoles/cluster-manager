<?php

namespace Kuroi\Cluster;

class Config
{
    /**
     * @var array
     */
    protected $configs = [];

    /**
     * Initialise configs.
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $this->configs = $configs;
    }

    /**
     * Get a setting.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed config setting or default when not found
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->configs) ? $this->configs[$key] : $default;
    }

    /**
     * Check existence of an item by key.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->configs);
    }

    /**
     * Set a setting.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->configs[$key] = $value;

        return $this;
    }
}
