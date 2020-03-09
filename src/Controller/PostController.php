<?php
namespace App\Controller;

use App\Manager\{
    PostManager,
    CommentManager
};

class PostController
{
    private $postManager;
    private $commentManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function listPosts()
    {
        $totalArticleNumber = $this->postManager->getTotal();
        $currentPage = (int)($_GET['page'] ?? 1);
        $perPage = 6;
        $totalPages = ceil($totalArticleNumber / $perPage);
        $offset = $perPage * ($currentPage - 1);

        $posts = $this->postManager->getPosts($perPage, $offset);

        require('src/view/listPostsView.php');
    }

    public function post($postId)
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($postId);
        //$comments=$this->commentManager->getComments($_GET['id']);

        require('src/view/postView.php');
    }
}
