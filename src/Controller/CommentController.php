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

    public function reportComment()
    {
        if ($_SESSION) {
            $this->commentManager->getComment($_GET['id']);
            $this->commentManager->updateStatusComment($_GET['id']);
            $this->p = 'Comment reported';
//            var_dump($_GET);
            header('Location: index.php?action=post&id=' . $_GET['postId']);
        } else {
            $this->p = 'You are not logged in';
            require 'view/errorView.php';
        }
    }

    public function supComment()
    {
        $comments = $this->commentManager->getAdminComments();
        $this->commentManager->deleteComment($_GET['id']);
        $this->msg = 'Comment Deleted';
        header('Location: index.php?action=showAdminCommentsView');
    }
}