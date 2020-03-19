<?php
namespace App\Controller;

use App\Manager\{CommentManager,
    PostManager,
    UserManager
};

use App\Model\{
    Comment,
    Post
};

class AdminController {
    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->comment = new Comment();
        $this->post = new Post();
    }

    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    public function manageDashboard() // affiche la liste des articles dans l'interface admin
    {
        $comments = $this->commentManager->getNbCommentAdmin();

        //$commentList = new CommentManager();
        //$comments = $commentList->getCommentsAdmin();
        require 'src/view/adminView.php';
    }

    // COMMENT ADMINSTRATION
    public function reportComment() {
        $this->commentManager->statusComment($commentId);
        echo "hello";
    }

    public function manageReportedComments() {
        $this->commentManager->selectReportedComments();
    }

    // POST ADMINISTRATION
    public function modifyPost() {
        $post = $this->postManager->getPost($postId);

        require "src/view/modifyPostView.php";
    }

    public function deletePost() {

    }
}