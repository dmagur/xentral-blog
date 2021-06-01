<?php
namespace Blog\Interface;

interface ControllerInterface
{
    public function out(string $view,string $layout,array $data);

    public function redirect(string $path);
}
