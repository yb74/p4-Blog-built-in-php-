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


    /**
     * Function to create an account
     */
    public function userRegister()
    {
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->userManager->getAuth($_POST['username']);
            if (empty(trim($_POST['username'])) && empty(trim($_POST['password'])) && empty(trim($_POST["confirm_password"]))) {
                $errors['form'] = "Please, fill in the form.";
            }
            elseif (empty(trim($_POST['username']))) {
                $errors['form'] = "Please enter a username.";
            }
            elseif ($user) {
                $errors['form'] = "This username is already taken.";
            }
            elseif (empty(trim($_POST['password']))) {
                $errors['form'] = "Please enter a password.";
            }
            elseif (strlen(trim($_POST["password"])) < 6 && strlen(trim($_POST["confirm_password"])) < 6) {
                $errors['form'] = "The password must contain at least 6 characters.";
            }
            elseif (empty(trim($_POST['confirm_password']))) {
                $errors['form'] = "Please confirm password.";
            }
            elseif (($_POST["password"] != $_POST["confirm_password"])) {
                $errors['form'] = "Password did not match.";
            }
            elseif (!empty(trim($_POST['username'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST["confirm_password"]))) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $this->userManager->pushUserInfo(ucfirst(htmlspecialchars($_POST['username'])), $hashedPassword);
                header('Location: /connection');
            }
        }
        require 'src/view/registrationView.php';
    }

    /**
     * Function to log in
     */
    public function userAuth() {
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->userManager->getAuth($_POST['username']);
            if (empty($_POST['username']) && empty($_POST['password'])) {
                $errors['form'] = "Please, fill in the form.";
            }
            elseif (empty($_POST['username'])) {
                $errors['form'] = "Please enter a username.";
            }
            elseif (!$user) {
                $errors['form'] = "This username doesn't exist.";
            }
            elseif (empty($_POST['password'])) {
                $errors['form'] = "Please enter a password.";
            }
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $user = $this->userManager->getAuth($_POST['username']);

                if($user) {
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
                        $errors['form'] = "Your username and your password don't match.";
                        require 'src/view/connectionView.php';
                        return;
                    }
                }
                else {
                    $errors['form'] = "This username doesn't exist.";
                    require 'src/view/connectionView.php';
                    return;
                }
            }
            require 'src/view/connectionView.php';
        } else {
            require 'src/view/connectionView.php';
        }
    }


    /**
     * Function to log out
     */
    public function logOut() {
        unset($_SESSION['id']);
        // Unset all of the session variables
        $_SESSION = array();
        // Destroy the session.
        session_destroy();
        // Redirect to the homepage
        header('Location: /');
        exit;
    }
}