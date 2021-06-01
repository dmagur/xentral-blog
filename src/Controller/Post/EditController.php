<?php

namespace Blog\Controller\Post;

use Blog\Services\PostHydrator;
use Blog\Services\SlugGenerator;
use Blog\Services\Validator;
use Blog\Core\Controller;
use Blog\Entity\Post;
use Blog\Interface\PersistanceInterface;
use Blog\Repository\PostRepository;

class EditController extends Controller
{
    private PostRepository $postRepository;

    private PostHydrator $postHydrator;

    private Validator $validator;

    public function __construct(PersistanceInterface $persistance, \Smarty $smarty)
    {
        $this->postRepository = new PostRepository($persistance);
        $this->postHydrator = new PostHydrator(new SlugGenerator());
        $this->validator = new Validator();
        parent::__construct($persistance, $smarty);
    }

    function process()
    {
        $errors = [];
        if (isset($_REQUEST['submit']) and $_REQUEST['submit']) {
            $_REQUEST['data']['user_id'] = $_SESSION['uid'];
            $_REQUEST['data']['post_date'] = date("Y-m-d H:i:s", strtotime($_REQUEST['data']['post_date']));

            $post = new Post();
            $errors = $this->validator->validate($post, $_REQUEST['data']);

            if (empty($errors)) {
                $post = $this->postHydrator->hydrate($post, $_REQUEST['data']);

                if (empty($_REQUEST['data']['id'])) {
                    $this->postRepository->insert($post);
                } else {
                    $this->postRepository->update($post);
                }

                $this->redirect('/post/' . $post->getSlug());
                unset($_REQUEST['data']);
            }
        }

        if (!empty($_REQUEST['params'])) {
            $_REQUEST['data']['id'] = $_REQUEST['params'][0];
            $_REQUEST['data'] = $this->postRepository->getOneById($_REQUEST['data']['id']);
        }

        $this->out('edit_post', 'default', ['errors' => $errors, 'request' => $_REQUEST]);
    }
}
