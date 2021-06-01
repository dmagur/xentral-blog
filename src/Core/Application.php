<?php
namespace Blog\Core;

use Blog\Interface\ApplicationInterface;
use Blog\Interface\ConfigProviderInterface;
use Blog\Interface\PersistenceInterface;

class Application implements ApplicationInterface
{
    private string $route;

    private ConfigProviderInterface $route_config;

    private PersistenceInterface $persistence;

    private \Smarty $smarty;

    function __construct(string $route, ConfigProviderInterface $route_config, PersistenceInterface $persistence, \Smarty $smarty)
    {
        $this->route = $route;
        $this->route_config = $route_config;
        $this->persistence = $persistence;
        $this->smarty = $smarty;
    }

    function run()
    {
        $controller = $this->route_config->get($this->route);
        $controller_class = new $controller['class']($this->persistence,$this->smarty);
        return $controller_class->{$controller['method']}();
    }
}
