<?php
namespace Blog\Controller;

use Blog\Services\Authenticator;
use Blog\Core\Controller;
use Blog\Interface\PersistenceInterface;
use Blog\Repository\UserRepository;

class LoginController extends Controller
{
    private Authenticator $authenticator;

    private UserRepository $userRepository;

    public function __construct(PersistenceInterface $persistence, \Smarty $smarty)
    {
        $this->userRepository = new UserRepository($persistence);
        $this->authenticator = new Authenticator($this->userRepository);
        parent::__construct($persistence, $smarty);
    }

    function index()
    {
        if (isset($_REQUEST['submit'])) {
            $this->authenticator->login($_REQUEST['email'], $_REQUEST['password']);
        }

        if (isset($_SESSION['uid'])) {
            $this->redirect("/");
        }

        $this->out('login');
    }
}
