<?php
namespace App\Controller;

use App\Model\Comment;

use App\Manager\CommentManager;


class CommentController
{
    public function __construct()
    {
        $this->commentManager = new CommentManager();
    }

    public function commentReport($commentId) {
        if (isset($commentId) && ($commentId > 0)) {
            $comment = new Comment();
            $comment->setId($commentId);
            $this->commentManager->reportComment($comment);
            header('Location: /');
            //header('Location: /chapter' . $relatedId);

            var_dump($_GET);
        }
        else {
            $this->msg='No comment id has been sent !';
            require('src/view/errorView.php');
        }
    }
}