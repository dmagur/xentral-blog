<?php

namespace Blog\Controller\Post;

use Blog\Services\DateFormatter;
use Blog\Core\Controller;
use Blog\Interface\PersistenceInterface;
use Blog\Repository\PostRepository;
use Blog\Repository\UserRepository;

class DetailsController extends Controller
{
    private DateFormatter $dateFormatter;

    private PostRepository $postRepository;

    private UserRepository $userRepository;

    public function __construct(PersistenceInterface $persistence, \Smarty $smarty)
    {
        $this->dateFormatter = new DateFormatter();
        $this->postRepository = new PostRepository($persistence);
        $this->userRepository = new UserRepository($persistence);
        parent::__construct($persistence, $smarty);
    }

    function details()
    {
        if (empty($_REQUEST['params'])) {
            $this->redirect("/");
        }

        $errors = array();
        $slug = $_REQUEST['params'][0];
        $data = $this->postRepository->getOne($slug);
        if (!$data) $this->redirect("/");

        $data['post_date'] = $this->dateFormatter->formatDate($data['post_date']);

        $userdata = [];
        if (!empty($_SESSION['uid'])) {
            $userdata = $this->userRepository->getOneById($_SESSION['uid']);
        }

        $this->out('post_details','default',['post' => $data, 'errors' => $errors, 'request' => $_REQUEST, 'userdata' => $userdata]);
    }
}
