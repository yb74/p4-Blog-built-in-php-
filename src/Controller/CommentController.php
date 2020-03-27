<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Model\Comment;

use App\Manager\CommentManager;


class CommentController
{
    public function __construct()
    {

        // $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->comment = new Comment();
    }

    public function commentReport($commentId) {
        if (isset($commentId) && ($commentId > 0)) {
            $this->comment->setId($commentId);
            $this->commentManager->reportComment($this->comment);
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