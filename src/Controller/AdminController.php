<?php
namespace App\Controller;

use App\Manager\{CommentManager,
    PostManager,
    UserManager
};

use App\Model\{
    Comment,
    Post,
    user,
    Img
};

class AdminController {
    public $msg= "";

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
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

    public function commentDelete($commentId) {
        if (isset($commentId) && ($commentId > 0)) {
            $comment = new Comment();
            $comment->setId($commentId);
            $this->commentManager->deleteComment($comment);
            header('Location: /manageComments');
        }
        else {
            $this->msg='No comment id has been sent !';
            require('src/view/errorView.php');
        }
    }

    public function commentUnreport($commentId) {
        if (isset($commentId) && ($commentId > 0)) {
            $comment = new Comment();
            $comment->setId($commentId);
            $this->commentManager->unreportComment($comment);
            header('Location: /manageComments');
        }
        else {
            $this->msg='No comment id has been sent !';
            require('src/view/errorView.php');
        }
    }

    // POST ADMINISTRATION
    public function createPost() {

        //$errors = [];

        $errors['picture']="";
        $errors['title']="";
        $errors['content']="";
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['picture_url']['error']  > 0 && empty($_POST['title']) && empty($_POST['content'])) {
                $errors['form'] = "Please, fill in the form !";
            }
            if (empty($_FILES['picture_url'])) {
                $errors['picture'] = "Please, upload a picture !";
            }
            if (empty($_POST['title'])) {
                $errors['title'] = "Please, enter a title !";
            }
            if (empty($_POST['content'])) {
                $errors['content'] = "Please, enter a content !";
            }
            else {
                $img = $_FILES['picture_url'];
                $ext = strtolower(substr($img['name'], -3)); // contains the file extension
                $allow_ext = array("jpg", "png", "gif");
                //$destination = "public/images/chapters/" . $img['name'];
                if (in_array($ext, $allow_ext)) {
                    //move_uploaded_file($img['tmp_name'], $destination);
                     move_uploaded_file($img['tmp_name'], "public/images/chapters/" . $img['name']);
                    $destination = "public/images/chapters/" . $img['name'];

                    $post = new Post();
                    $post->setPictureUrl($destination);
                    $post->setTitle($_POST['title']);
                    $post->setContent($_POST['content']);
                    //$this->post->setId($postId);
                    $this->postManager->addPost($post);
                    echo $img;
                    header('Location: /admin');
                    die; // no need to require the view
                }
                else {
                    $errors['picture'] = "Your file is not a picture !";
                }
            }
        }
        require('src/view/createPostView.php');
        return;
    }

//    public function createPost() {
//
//        $errors = [];
//
//        $errors['picture']="";
//        $errors['title']="";
//        $errors['content']="";
//        $errors['form']="";
//
//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            // $fileName = $_FILES['picture_url']['name'];
//            if ($_FILES['picture_url']['size'] !== 0 && !empty($_POST['title']) && !empty($_POST['content'])) {
//                $img = $_FILES['picture_url'];
//                $ext = strtolower(substr($img['name'], -3)); // contains the file extension
//                $allow_ext = array("jpg", "png", "gif");
//                // $img["size"] > 73355
//
//                if (in_array($ext, $allow_ext)) {
//
//                    /*$picturePath = "public/images/chapters/";
//                    $imageNameAndExt = $img['name'];
//                    $imageNameIsolation = explode(".", $imageNameAndExt);
//                    $newName = $imageNameIsolation[0];
//                    $newExt = strtolower($imageNameIsolation[1]);*/
//
//                    move_uploaded_file($img['tmp_name'], "public/images/chapters/" . $img['name']);
//                    // Img::createMin("public/images/chapters/" . $img['name'], "public/images/chapters/min/", $img['name'], 1250, 350);
//                    // Img::convertJPG("public/images/chapters/" . $img['name']);
//
//                    // $destination = "public/images/chapters/min/" . $img['name'];
//                    $destination = "public/images/chapters/" . $img['name'];
//
//                    $post = new Post();
//                    $post->setPictureUrl($destination);
//                    $post->setTitle($_POST['title']);
//                    $post->setContent($_POST['content']);
//
//                    $this->postManager->addPost($post);
//
//                    header('Location: /admin');
//                } else {
//                    $errors['picture'] = "Your file is not a picture !";
//                }
//            }
//            /*elseif (empty($_FILES['picture_url'])) {
//                $errors['picture'] = "Please, upload a picture !";
//            }
//            elseif (empty($_POST['title'])) {
//                $errors['title'] = "Please, enter a title !";
//            }
//            elseif (empty($_POST['content'])) {
//                $errors['content'] = "Please, enter a content !";
//            }*/
//
//            else {
//                $errors['form'] = "Please, fill in the form !";
//            }
//        }
//        require('src/view/createPostView.php');
//        return;
//    }

    public function modifyPost($postId) {

        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['title']) && empty($_POST['content'])) {
                $errors['form'] = "Please, fill in the form !";
            }
            elseif (empty($_POST['title'])) {
                $errors['form'] = "Please, enter a title !";
            }
            elseif (empty($_POST['content'])) {
                $errors['form'] = "Please, enter a content !";
            }
            else {
                $post = new Post();
                $post->setTitle(htmlspecialchars($_POST['title']));
                $post->setContent($_POST['content']);
                $post->setId($postId);
                $this->postManager->updatePost($post);

                header('Location: /admin');
            }
        }
        $post = $this->postManager->getPost($postId);
        require "src/view/modifyPostView.php";
        return;
    }

    public function postDelete($postId) {
        if (isset($postId) && $postId > 0) {
            $post = new Post();
            $post->setId($postId);
            $this->postManager->deletePost($post);
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
            $user = new User();
            $user->setId($userId);
            $this->userManager->deleteUser($user);
            header('Location: /manageUsers');
        }
        else {
            $this->msg='No user id has been sent !';
            require('src/view/errorView.php');
        }
    }
}