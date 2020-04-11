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

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
    }

    /**
     * Function to show error page
     */
    public function displayError() {
        require 'src/view/errorView.php';
    }

    /**
     * Function to access to the dashboard as an admin
     */
    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    /**
     * Function to display dashboard content
     */
    public function manageDashboard() // Display information about posts in the dashboard
    {
        $posts = $this->postManager->getDashboardPosts();

        require 'src/view/adminView.php';
    }

    // COMMENT ADMINISTRATION
    /**
     * Function to display the reported comments on the comment dashboard
     */
    public function manageComments() {
        $comments  = $this->commentManager->getReportedComments();

        require "src/view/manageCommentsView.php";
    }

    /**
     * Function to delete a reported comment
     */
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

    /**
     * Function to unreport a comment
     */
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

    /**
     * Function to create a post
     */
    public function createPost() {
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST'):
            if (!empty($_FILES) && !empty($_POST['title']) && !empty($_POST['content'])):

                $temporaryPath= $_FILES['picture_url']['tmp_name'];
                $fileName= $_FILES['picture_url']['name'];

                // securing the website by renaming an uploaded picture and adding a "." sign to its name so the security can't be bypassed by the user by modifying the extension name of the uploaded file
                $temp=explode(".",$fileName); // isolation of the "." and the name of the uploaded file
                $newName=round(microtime(true)).'.'.end($temp); // renaming the uploaded file by generating a random number as the new filename and incremeting a "." symbol
                $finalPath= 'public/images/chapters/uploaded_pictures/'.$newName;
                $fileExtension= strrchr($newName, "."); // isolation of the file extension
                $extensionAllowed= array('.jpg', '.JPG', '.jpeg', '.JPEG', '.png', '.PNG', '.gif', '.GIF');
                $maxSize = 2000000;
                $size = ($_FILES['picture_url']['size']);

                if(in_array($fileExtension,$extensionAllowed) && $size<$maxSize && $size!==0):
                    $movePath= move_uploaded_file($temporaryPath,$finalPath);
                    if($movePath):

                    $post = new Post();
                    $post->setPictureUrl($finalPath);
                    $post->setTitle($_POST['title']);
                    $post->setContent($_POST['content']);

                    $this->postManager->addPost($post);

                    header('Location: /admin');
                    else:
                     $errors['form'] = "An error has occured during the uploading process of your file";
                    endif;
                elseif(in_array($fileExtension,$extensionAllowed) && $size>$maxSize || $size ==0):
                    $errors['form'] = "The uploaded file size can't exceed 2Mo";
                else:
                    $errors['form'] = 'You are allowed to upload jpg, png, or gif files only';
                endif;
            else:
                $errors['form'] = "Please, fill in the form !";
            endif;
        endif;
        require('src/view/createPostView.php');
    }

    /**
     * Function to update a post
     */
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
                $post->setTitle($_POST['title']);
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

    /**
     * Function to delete a message
     */
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
    /**
     * Function to get the user list form the user dashboard
     */
    public function manageUsers() {
        $users  = $this->userManager->getUserList();
        require 'src/view/userslistView.php';
    }

    /**
     * Function to delete a user
     */
    public function userDelete($userId) {
        if (isset($userId) && ($userId > 0)) {
            $user = new User();
            $user->setId($userId);
            $this->userManager->deleteUser($user);
            header('Location: /manageUsers');
        }
        else {
            $this->msg='No user id has been sent !'; //error
            require('src/view/errorView.php');
        }
    }
}