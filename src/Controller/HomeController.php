<?php
namespace Blog\Controller;

use Blog\Services\DateFormatter;
use Blog\Core\Controller;
use Blog\Interface\PersistenceInterface;
use Blog\Repository\PostRepository;

class HomeController extends Controller
{
    private DateFormatter $dateFormatter;

    private PostRepository $postRepository;

    public function __construct(PersistenceInterface $persistence, \Smarty $smarty)
    {
        $this->dateFormatter = new DateFormatter();
        $this->postRepository = new PostRepository($persistence);
        parent::__construct($persistence, $smarty);
    }

    function index()
    {
        $pagesize = 3;
        $_REQUEST['page'] = $page = ($_REQUEST['page']) ?? 1;
        $offset = ($page - 1) * $pagesize;
        $params = ['orderby' => 'order by post_date desc,id desc','limit' => "LIMIT $pagesize OFFSET $offset"];

        $posts = $this->postRepository->getList($params);
        $total_pages = 0;

        if ($posts) {
            $total_pages = ceil($posts['total_records']/$pagesize);

            foreach ($posts['records'] as $key => $post) {
                $posts['records'][$key]['post_date'] = $this->dateFormatter->formatDate($post['post_date']);
            }
        }

        $this->out('home','default',['posts' => $posts['records'] ?? [],'request' => $_REQUEST,'total_pages' => $total_pages]);
    }
}
