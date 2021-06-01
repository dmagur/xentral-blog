<?php
namespace Blog\Controller;

use Blog\Core\Controller;

class LogoutController extends Controller
{
    function index()
    {
        if (isset($_SESSION['uid'])) {
            unset($_SESSION['uid']);
        }

        $this->redirect('/');
    }
}
