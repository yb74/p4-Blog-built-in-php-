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


class CommentController
{
    public $username_help = "";
    public $content_help = "";

    public function __construct()
    {
        $this->commentManager = new CommentManager();
        $this->comment = new Comment();
    }

    public function addComment($related_id)
    {
        if(isset($_POST["send_data"])) {
            //$comment = ['related_id' => $_GET['related_id'], 'author' => $_GET['author'], 'content' => $_GET['content']];


            //$this->commentManager->postComment($comment);
            //$commentManager = new CommentManager();
            //$commentManager->postcomment($comment);

            $this->comment->setAuthor($_POST['author']);
            $this->comment->setContent($_POST['content']);
            $this->comment->setRelatedId($related_id);
            $this->commentManager->postComment($this->comment);

            echo '<pre>';
            var_dump($this->comment);
            echo '</pre>';

            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';

            if (empty($_POST['author']) && empty($_POST['content']))
            {
                $this->username_help = "Please, enter your username !";
                $this->content_help = "Please, enter a comment !";

                //header('Location: /chapter');
                require 'src/view/postView.php';
                return;
            } else {
                header('Location: /chapter' . $related_id);
                //require 'src/view/postView.php';
            }
        } else {
            header('Location: /chapter' . $related_id);
            require 'src/view/postView.php';
        }
    }

    public function reportComment() {
        $this->commentManager->statusComment($commentId);
        echo "hello";
    }

    public function manageReportedComments() {
        $this->commentManager->selectReportedComments();
    }
}