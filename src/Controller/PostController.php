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

        /*echo "<pre>";
        var_dump($posts);
        echo "</pre">;*/
        require('src/view/listPostsView.php');
    }

    public function post($postId)
    {
        $author_help = null;
        $content_help = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['author']) && isset($_POST['content'])) {
                $this->comment->setAuthor($_POST['author']);
                $this->comment->setContent($_POST['content']);
                $this->comment->setRelatedId($postId);
                $this->commentManager->postComment($this->comment);

                header('Location: /chapter' . $postId);
            }
            else if (empty($_POST['author'])) {
                    $author_help = "Please, enter your username !";
            } else if (empty($_POST['content'])) {
                $content_help = "Please, enter a comment !";
            }
        }

        $post  = $this->postManager->getPost($postId);

        /*if($post === false || $comments === false){
            header("HTTP:1.0 404 Not Found");
            header('Location:index.php');
        }*/

        /*echo "<pre>";
        var_dump($post);
        echo "</pre>";

        echo "<pre>";
        var_dump($comments);
        echo "</pre>";
        */

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
