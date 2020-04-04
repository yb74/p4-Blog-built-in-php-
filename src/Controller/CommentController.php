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

    public function reportComment($commentId) {
        $comment = new Comment();
        $comment->setId($commentId);

        $this->commentManager->updateCommentStatus($comment);
        $comment = $this->commentManager->getCommentRelatedId($comment);

        header('Location: /chapter' . $comment['related_id']);
    }
}