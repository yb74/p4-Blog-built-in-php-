<?php
namespace App\Manager;

class AdminManager extends Manager
{
    public function login($adminName)// permet de se connecter au compte admin
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, username, password, role FROM users WHERE username = ?');
        $req->execute(array($adminName));

        return $req;
    }
}

