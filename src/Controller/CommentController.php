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

    public function reportComment($postId) {
            $comment = new Comment();
            $comment->setId($commentId);
            $this->commentManager->updateCommentStatus($comment);
            $this->commentManager->getComment($postId);
            //$this->commentManager->getReportedCommentId($comment);

            //header('Location: /');
            //header('Location: /chapter' . $postId);
        var_dump($postId);
    }
}