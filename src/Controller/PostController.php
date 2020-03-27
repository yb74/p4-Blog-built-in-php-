<?php
namespace App\Controller;

use App\Model\{
    Post,
    Comment
};
use App\Manager\{
    PostManager,
    CommentManager
};

class PostController
{
    public $author_help = "";
    public $content_help = "";

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->comment = new Comment();
        $this->posts = new Post();
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['author'])) {
                $this->author_help = "Please, enter your username !";
            }
            if (empty($_POST['content'])) {
                $this->content_help = "Please, enter a comment !";
            }
            else if (isset($_POST['author']) && isset($_POST['content'])) {
                $this->comment->setAuthor($_POST['author']);
                $this->comment->setContent($_POST['content']);
                $this->comment->setRelatedId($postId);
                $this->commentManager->postComment($this->comment);

                header('Location: /chapter' . $postId);
            }
        }

        $post  = $this->postManager->getPost($postId);
        $comments  = $this->commentManager->getComments($postId);

        require('src/view/postView.php');
    }

    public function reportComment() {
        $this->commentManager->statusComment($commentId);
        echo "hello";
    }

    public function manageReportedComments() {
        $this->commentManager->selectReportedComments();
    }
}
