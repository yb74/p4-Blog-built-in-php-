<?php
namespace App\Controller;

//use App\Manager\RegistrationManager;

require_once 'src/Manager/RegistrationManager.php';

class RegistrationController
{
    public $username =  "";
    public $password = "";
    public $confirm_password = "";
    public $username_err  =  "";
    public $password_err = "";
    public $confirm_password_err = "";
    public $id = "";

    public function addNewUser($username, $password)
    {
        $user = $_POST['username'];
        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $registrationManager = new RegistrationManager();
            if (empty(trim($_POST["username"])) || empty(trim($_POST["password"])) || empty(trim($_POST["confirm_password"]))) {
                // echo 'nope';
                $this->username_err = "Please enter a username.";
                $this->password_err = "Please enter a password.";
                $this->confirm_password_err = "Please confirm password.";
                require 'template/template.php';
                return;
            }
            if ($user = $registrationManager->matchUser($this->username) == true) {
                $this->username_err = "This username is already taken.";
                require 'template/template.php';
                return;
            }
            if (strlen(trim($_POST["password"])) < 6 && trim($_POST["confirm_password"]) < 6) {
                $this->password_err = "Password must have atleast 6 characters.";
                require 'template/template.php';
                return;
            }
            if (($_POST["password"] != $_POST["confirm_password"])) {
                $this->confirm_password_err = "Password did not match.";
                require 'template/template.php';
                return;
            } else {
                $userAdded = $registrationManager->pushUserInfo($username, $password);
                require 'template/template.php';
            }
        }
    }
}