<?php

namespace Blog\Controller\Post;

use Blog\Core\Controller;
use Blog\Interface\PersistanceInterface;
use Blog\Repository\PostRepository;

class DeleteController extends Controller
{
    private PostRepository $postRepository;

    public function __construct(PersistanceInterface $persistance, \Smarty $smarty)
    {
        $this->postRepository = new PostRepository($persistance);
        parent::__construct($persistance, $smarty);
    }

    function delete()
    {
        $_REQUEST['id'] = $_REQUEST['params'][0] ?? null;
        if (!isset($_REQUEST['id'])) {
            $this->redirect("/");
            return;
        }

        $data = $this->postRepository->getOneById($_REQUEST['id']);
        if (empty($data)) {
            $this->redirect("/");
            return;
        }

        if (empty($_SESSION['uid']) or $data['user_id'] != $_SESSION['uid']) {
            header("HTTP/1.0 403 Access denied");
            exit;
        }

        $this->postRepository->deleteById($_REQUEST['id']);
        $this->redirect("/");
    }
}
