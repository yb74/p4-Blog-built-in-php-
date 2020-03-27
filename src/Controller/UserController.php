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

    public $username_err = "";
    public $password_err = "";
    public $confirm_password_err = "";
    public $empty_inputs_err = "";

    public function userRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->userManager->getAuth($_POST['username']);

            if (empty(trim($_POST['username'])) && empty(trim($_POST['password'])) && empty(trim($_POST["confirm_password"]))) {
                //$this->username_err = "Please enter a username.";
                //$this->password_err = "Please enter a password.";
                //$this->confirm_password_err = "Please confirm password.";
                $this->empty_inputs_err = "Please, fill in the form.";
                require 'src/view/registrationView.php';
                return;
            }
            elseif (empty(trim($_POST['username']))) {
                $this->username_err = "Please enter a username.";
                require 'src/view/registrationView.php';
                return;
            }
            elseif (empty(trim($_POST['password']))) {
                $this->password_err = "Please enter a password.";
                require 'src/view/registrationView.php';
                return;
            }
            elseif (empty(trim($_POST['confirm_password']))) {
                $this->confirm_password_err = "Please confirm password.";
                require 'src/view/registrationView.php';
                return;
            }
            elseif ($user) {
                $this->username_err = "This username is already taken.";
                require 'src/view/registrationView.php';
                return;
            }
            elseif (strlen(trim($_POST["password"])) < 6 && strlen(trim($_POST["confirm_password"])) < 6) {
                $this->password_err = "The password must contain at least 6 characters.";
                require 'src/view/registrationView.php';
                return;
            }
            elseif (($_POST["password"] != $_POST["confirm_password"])) {
                $this->confirm_password_err = "Password did not match.";
                require 'src/view/registrationView.php';
                return;
            }
            else {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $this->userManager->pushUserInfo($username, $hashedPassword);

                header('Location: /connection');
            }
        } else {
            require 'src/view/registrationView.php';
        }
    }

    public function userAuth() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['username']) && empty($_POST['password'])) {
                $this->empty_inputs_err = "Please, fill in the form.";

                require 'src/view/connectionView.php';
                return;
            }
            elseif (empty($_POST['username'])) {
                $this->username_err = "Please enter a username.";

                require 'src/view/connectionView.php';
                return;
            }
            elseif (empty($_POST['password'])) {
                $this->password_err = "Please enter a password.";

                require 'src/view/connectionView.php';
                return;
            }
            else {
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
                        $this->empty_inputs_err = "Your username and your password don't match.";
                        //$this->password_err = "Your username and your password don't match.";
                        require 'src/view/connectionView.php';
                    }
                }
                else {
                    $this->empty_inputs_err = "This username doesn't exist.";
                    //$this->username_err = "This username doesn't exist.";
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