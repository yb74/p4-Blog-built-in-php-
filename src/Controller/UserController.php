<?php

namespace App\Controller;

use App\Manager\{
    CommentManager,
    PostManager,
    UserManager
};

class UserController
{
    public $confirm_password = "";
    public $username_err = "";
    public $password_err = "";
    public $confirm_password_err = "";

    public function displayWelcomeView() {
        require 'src/view/welcomeView.php';
    }

    public function userRegister()
    {
        if(isset($_POST["send_data"])) {
            $userManager = new UserManager();
            $user = $userManager->getAuth($_POST['username']);

            if (empty(trim($_POST['username'])) || empty(trim($_POST['password'])) || empty(trim($_POST["confirm_password"]))) {
                $this->username_err = "Please enter a username.";
                $this->password_err = "Please enter a password.";
                $this->confirm_password_err = "Please confirm password.";
                require 'src/view/registrationView.php';
                return;
            }
            if ($user) {
                //var_dump($user);
                $this->username_err = "This username is already taken.";
                require 'src/view/registrationView.php';
                return;
            }
            if (strlen(trim($_POST["password"])) < 6 && trim($_POST["confirm_password"]) < 6) {
                $this->password_err = "The password must contain at least 6 characters.";
                require 'src/view/registrationView.php';
                return;
            }
            if (($_POST["password"] != $_POST["confirm_password"])) {
                $this->confirm_password_err = "Password did not match.";
                require 'src/view/registrationView.php';
                return;
            }
            else {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $userManager = new UserManager();
                $userManager->pushUserInfo($username, $hashedPassword);

                header('Location: /welcome');
            }
        } else {
            require 'src/view/registrationView.php';
        }
    }

    public function userAuth() {
        if(isset($_POST["send_data"])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $postManager = new PostManager();
                $commentManager = new CommentManager();
                $userManager = new UserManager();

                $user = $userManager->login($username);

                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();
                    if ($user->getRole() === 'admin') {

                        header('Location: /admin');

                    } else {
                        header('Location: /');
                    }

                    var_dump($_SESSION);
                } else {
                    echo "Forgot your password ?";
                    var_dump($user);
                }
            }
            require 'src/view/connectionView.php';
        } else {
            require 'src/view/connectionView.php';
        }
    }

    public function logOut() {
        unset($_SESSION['id']);
        // Unset all of the session variables
        $_SESSION = array();
        // Destroy the session.
        session_destroy();
        // Redirect to logout page
        require "src/view/logoutView.php";
        exit;
    }

    // ADMIN FUNCTIONS
    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    public function dashboardPost($currentPage, $offset) // affiche la liste des articles dans l'interface admin
    {
        $postsList = new PostManager();
        $posts = $postsList->listPosts($currentPage, $offset);
        //$commentList = new CommentManager();
        //$comments = $commentList->getCommentsAdmin();
        var_dump($posts);
        require 'src/view/adminView.php';
    }
}