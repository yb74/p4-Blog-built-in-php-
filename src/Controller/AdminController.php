<?php
namespace App\Controller;

use App\Manager\{CommentManager,
    PostManager,
    UserManager
};

use App\Model\{
    Comment,
    Post,
    user
};

class AdminController {
    public $msg= "";
    public $empty_inputs_err = "";
    public $uploadPicture_help = "";
    public $createTitle_help = "";
    public $createContent_help = "";
    public $modifyTitle_help = "";
    public $modifyContent_help = "";

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->comment = new Comment();
        $this->post = new Post();
        $this->user = new user();
    }

    // Show error page
    public function displayError() {
        require 'src/view/errorView.php';
    }

    // Show dashboard
    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    public function manageDashboard() // Display information about posts in the dashboard
    {
        //$comments = $this->commentManager->getNbCommentAdmin();
        $posts = $this->postManager->getDashboardPosts();

        require 'src/view/adminView.php';
    }

    // COMMENT ADMINISTRATION
    public function manageComments() { // Display the reported comments
        $comments  = $this->commentManager->getReportedComments();

        require "src/view/manageCommentsView.php";
    }

    // Function to report a comment
    public function reportComment() {
        $this->commentManager->statusComment($commentId);
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['picture_url']) && empty($_POST['title']) && empty($_POST['content'])) {
                $this->empty_inputs_err = "Please, fill in the form !";
            }
            elseif (empty($_POST['picture_url'])) {
                $this->uploadPicture_help = "Please, upload a picture !";
            }
            elseif (empty($_POST['title'])) {
                $this->createTitle_help = "Please, enter a title !";
            }
            elseif (empty($_POST['content'])) {
                $this->createContent_help = "Please, enter a content !";
            }
            else {
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['title']) && empty($_POST['content'])) {
                $this->empty_inputs_err = "Please, fill in the form !";
            }
            elseif (empty($_POST['title'])) {
                $this->modifyTitle_help = "Please, enter a title !";
            }
            elseif (empty($_POST['content'])) {
                $this->modifyContent_help = "Please, enter a content !";
            }
            else {
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

    // USER ADMINISTRATION
    public function manageUsers() {
        $users  = $this->userManager->getUserList();
        require 'src/view/userslistView.php';
    }

    public function userDelete($userId) {
        if (isset($userId) && ($userId > 0)) {
            $this->user->setId($userId);
            $this->userManager->deleteUser($this->user);
            header('Location: /manageUsers');
        }
        else {
            $this->msg='No user id has been sent !';
            require('src/view/errorView.php');
        }
    }
}