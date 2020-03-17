<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Model\Comment;

use App\Manager\CommentManager;


class CommentController
{
    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->comment = new Comment();
    }

    public function reportComment() {
        $this->commentManager->statusComment($commentId);
        echo "hello";
    }

    public function manageReportedComments() {
        $this->commentManager->selectReportedComments();
    }

    public function getNbCommentAdmin() {
        $this->commentManager->getNbCommentAdmin();
    }
}