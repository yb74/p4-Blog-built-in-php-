<?php
namespace App\Manager;

use App\Model\User;

class UserManager extends Manager
{
    // Matching username and password
    public function getAuth($username) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, password, role FROM users WHERE username = ?');
        $req->execute(array($username));

        return $req->fetch();

        /*$data = $req->fetch();

        $user = new User();

        $user->setUsername($data["username"]);
        $user->setPassword($data["password"]);

        return $user;*/
    }

    public function pushUserInfo($username, $hashedPassword) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(username, password, registrationDate) VALUES (?, ?, NOW())');
        $req->execute(array($username, $hashedPassword));

        return $req;

        /*$data = $req->fetch();

        $user = new User();

        $user->setUsername($data["username"]);
        $user->setPassword($data["password"]);

        return $user;*/
    }

    public function login($username)// check if password entered match hashed password in database
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, password, username, role FROM users WHERE username = ?');
        $req->execute(array($username));

        $data = $req->fetch();

        $user = new User();

        $user->setId($data["id"]);
        $user->setPassword($data["password"]);
        $user->setUsername($data["username"]);
        $user->setRole($data["role"]);

        return $user;
    }
}

