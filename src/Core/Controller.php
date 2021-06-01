<?php
namespace Blog\Core;

use Blog\Exception\ViewException;
use Blog\Interface\ControllerInterface;
use Blog\Interface\PersistanceInterface;

class Controller implements ControllerInterface
{
    protected PersistanceInterface $persistance;

    protected \Smarty $smarty;

    function __construct(PersistanceInterface $persistance, \Smarty $smarty)
    {
        $this->persistance = $persistance;
        $this->smarty = $smarty;
    }

    /**
     * @throws ViewException|\SmartyException if layout file not found
     */
    function out(string $view,string $layout = 'default',array $data = array())
    {
        if (!file_exists(__DIR__ . '/../views/layouts/' . $layout . '.tpl')) {
            throw new ViewException("Layout not found");
        }

        $this->smarty->assign('data', $data);
        $this->smarty->assign('uid', ($_SESSION['uid']) ?? '');
        $this->smarty->assign('body', $this->smarty->fetch($view . ".tpl"));

        print $this->smarty->fetch('layouts/' . $layout . '.tpl');
    }

    function redirect(string $path)
    {
        header("Location:" . $path);
    }
}
