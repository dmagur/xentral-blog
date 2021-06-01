<?php
namespace Blog\Core;

use Blog\Interface\ConfigProviderInterface;
use Blog\Exception\ConfigException;

class Config implements ConfigProviderInterface
{
    private mixed $config;

    /**
     * @throws ConfigException
     */
    function __construct(string $name)
    {
        if (file_exists(__DIR__ . '/../config/' .$name.'.php')) {
            $this->config = include __DIR__ . '/../config/' . $name . '.php';
        } else {
            throw new ConfigException('config with name '.$name.' not found');
        }
    }

    public function get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
