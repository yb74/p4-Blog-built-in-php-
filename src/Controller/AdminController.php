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
    public $msg= "";

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->comment = new Comment();
        $this->post = new Post();
    }

    public function displayError() {
        require 'src/view/errorView.php';
    }

    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    public function manageDashboard() // affiche les infos des articles dans l'interface admin
    {
        //$comments = $this->commentManager->getNbCommentAdmin();
        $posts = $this->postManager->getDashboardPosts();

        //$commentList = new CommentManager();
        //$comments = $commentList->getCommentsAdmin();

        require 'src/view/adminView.php';
    }

    // COMMENT ADMINISTRATION
    public function manageComments() {
        $comments  = $this->commentManager->getReportedComments();

        require "src/view/manageCommentsView.php";
    }

    public function reportComment() {
        $this->commentManager->statusComment($commentId);
        echo "hello";
    }

    public function commentDelete($commentId) {
        if (isset($commentId) && ($commentId > 0)) {
            $this->comment->setId($commentId);
            $this->commentManager->deleteComment($this->comment);
            header('Location: /manageComments');
        }
        else {
            $this->msg='No comment id has been sent !';
            require('src/view/errorView.php');
        }
    }

    public function commentUnreport($commentId) {
        if (isset($commentId) && ($commentId > 0)) {
            $this->comment->setId($commentId);
            $this->commentManager->unreportComment($this->comment);
            header('Location: /manageComments');
        }
        else {
            $this->msg='No comment id has been sent !';
            require('src/view/errorView.php');
        }
    }

    // POST ADMINISTRATION
    public function createPost() {
        $uploadPicture_help = null;
        $createTitle_help = null;
        $createContent_help = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['picture_url'])) {
                $uploadPicture_help = "Please, upload a picture !";
            }
            if (empty($_POST['title'])) {
                $createTitle_help = "Please, enter a title !";
            }
            if (empty($_POST['content'])) {
                $createContent_help = "Please, enter a content !";
            }
            else if (isset($_POST['picture_url']) && isset($_POST['title']) && isset($_POST['content'])) {
                $this->post->setPictureUrl($_POST['picture_url']);
                $this->post->setTitle($_POST['title']);
                $this->post->setContent($_POST['content']);
                //$this->post->setId($postId);
                $this->postManager->addPost($this->post);

                header('Location: /admin');
            }
        }
        require('src/view/createPostView.php');
        return;
    }

    public function modifyPost($postId) {
        $modifyTitle_help = null;
        $modifyContent_help = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['title'])) {
                $modifyTitle_help = "Please, enter a title !";
            }
            if (empty($_POST['content'])) {
                $modifyContent_help = "Please, enter a content !";
            }
            else if (isset($_POST['title']) && isset($_POST['content'])) {
                $this->post->setTitle(htmlspecialchars($_POST['title']));
                $this->post->setContent($_POST['content']);
                $this->post->setId($postId);
                $this->postManager->updatePost($this->post);

                header('Location: /admin');
            }
        }
        $post = $this->postManager->getPost($postId);
        require "src/view/modifyPostView.php";
        return;
    }

    public function postDelete($postId) {
        if (isset($postId) && $postId > 0) {
            $this->post->setId($postId);
            $this->postManager->deletePost($this->post);
                header('Location: /admin');
        }
        else {
            $this->msg='No post id has been sent !';
            require('src/view/errorView.php');
        }
    }
}