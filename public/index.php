<?php
    error_reporting(E_ALL);
    require __DIR__ . '/../vendor/autoload.php';
    use Blog\Core\Application;
    use Blog\Core\Config;
    use Blog\Core\MySqlDatabase;

    session_start();
    try {
        $routes = new Config('routes');

        $dbconfig = new Config('database');
        $dbconnection = new MySqlDatabase($dbconfig);

        $smarty = new Smarty();
        $smarty->setTemplateDir('../src/views/');
        $smarty->setCompileDir('../src/views/templates_c/');

        $params = explode('/', $_REQUEST['action']);
        if (count($params) > 0) {
            $_REQUEST['action'] = array_shift($params);
            $_REQUEST['params'] = $params;
        }
        $app = new Application(($_REQUEST['action']) ?? 'default', $routes, $dbconnection, $smarty);
        $app->run();
    } catch (Exception $e) {
        var_dump($e);
    }
    session_write_close();
