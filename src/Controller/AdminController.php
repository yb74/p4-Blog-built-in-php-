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

    public function displayError() {
        require 'src/view/errorView.php';
    }

    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    public function manageDashboard() // affiche les infos des articles dans l'interface admin
    {
        $comments = $this->commentManager->getNbCommentAdmin();

        //$commentList = new CommentManager();
        //$comments = $commentList->getCommentsAdmin();
        require 'src/view/adminView.php';
    }

    // COMMENT ADMINSTRATION
    public function manageComments(){
        /*$modifyAuthor_help = null;
        $modifyContent_help = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['author'])) {
                $modifyAuthor_help = "Please, enter a username !";
            }
            if (empty($_POST['content'])) {
                $modifyContent_help = "Please, enter a content !";
            }
            else if (isset($_POST['author']) && isset($_POST['content'])) {
                $this->post->setTitle($_POST['author']);
                $this->post->setContent($_POST['content']);
                $this->post->setId($postId);
                $this->commentManager->updatePost($this->post);
                //var_dump($post);
                header('Location: /manageComments' . $postId);
            }
        }*/
        $comments  = $this->commentManager->getAllComments();

        require "src/view/manageCommentsView.php";
    }

    public function reportComment() {
        $this->commentManager->statusComment($commentId);
        echo "hello";
    }

    public function manageReportedComments() {
        $this->commentManager->selectReportedComments();
    }

    // POST ADMINISTRATION
    public function createPost(){
        require('src/view/createPostView.php');
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
                $this->post->setContent(htmlspecialchars($_POST['content']));
                $this->post->setId($postId);
                $this->postManager->updatePost($this->post);

                header('Location: /admin');
            }
        }
        $post = $this->postManager->getPost($postId);
        require "src/view/modifyPostView.php";
        return;
    }

    public function deletePost($postId) {
        $this->postManager->deletePost($postId);
        header('Location: /admin' . $postId);
    }
}