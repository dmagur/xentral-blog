<?php
namespace Blog\Interface;

interface ConfigProviderInterface
{
    public function get(string $name);
}
