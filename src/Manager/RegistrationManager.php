<?php
//namespace App\Manager;

require_once("src/Manager/Manager.php");
require_once('src/Model/User.php');

class RegistrationManager extends Manager
{
    public function pushUserInfo($username, $password) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(username, password) VALUES (?, ?)');
        $userAdded = $req->execute(array($username, $password));

        return $userAdded;
    }
}
