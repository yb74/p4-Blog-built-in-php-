<?php

namespace App\Controller;

use App\Manager\{
    CommentManager,
    UserManager
};

class UserController
{
    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->commentManager = new CommentManager();
    }

    public function userRegister()
    {
        $errors = [];

        $errors['username']="";
        $errors['password']="";
        $errors['confirm_password']="";
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty(trim($_POST['username'])) && empty(trim($_POST['password'])) && empty(trim($_POST["confirm_password"]))) {
                $errors['form'] = "Please, fill in the form.";
            }
            if (empty(trim($_POST['username']))) {
                $errors['username'] = "Please enter a username.";
            }
            if (empty(trim($_POST['password']))) {
                $errors['password'] = "Please enter a password.";
            }
            if (empty(trim($_POST['confirm_password']))) {
                $errors['confirm_password'] = "Please confirm password.";
            }

            $user = $this->userManager->getAuth($_POST['username']);

            if ($user) {
                $errors['username'] = "This username is already taken.";
            }
            if (strlen(trim($_POST["password"])) < 6 && strlen(trim($_POST["confirm_password"])) < 6) {
                $errors['password'] = "The password must contain at least 6 characters.";
            }
            if (($_POST["password"] != $_POST["confirm_password"])) {
                $errors['confirm_password'] = "Password did not match.";
            }
            if (count($errors) === 0) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $this->userManager->pushUserInfo($_POST['username'], $hashedPassword);
                header('Location: /connection');
                die; // no need to require the view
            }
        }
        require 'src/view/registrationView.php';
    }

    public function userAuth() {

        $errors = [];

        $errors['username']="";
        $errors['password']="";
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->userManager->getAuth($_POST['username']);
            if (empty($_POST['username']) && empty($_POST['password'])) {
                $errors['form'] = "Please, fill in the form.";
            }
            if (empty($_POST['username'])) {
                $errors['username'] = "Please enter a username.";
            }
            if (!$user) {
                $errors['username'] = "This username doesn't exists.";
            }
            if (empty($_POST['password'])) {
                $errors['password'] = "Please enter a password.";
            }
            else {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $user = $this->userManager->getAuth($_POST['username']);
                $user = $this->userManager->login($username);

                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();
                    $_SESSION['username'] = $user->getUsername();

                    if ($user->getRole() === 'admin') {
                        header('Location: /admin');
                    } else {
                        header('Location: /');
                    }

                } else {
                    $errors['password'] = "Your username and your password don't match.";
                    require 'src/view/connectionView.php';
                }
            }
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
        header('Location: /');
        exit;
    }
}