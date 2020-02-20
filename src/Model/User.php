<?php
namespace App\Model;

class User
{
    private $id;
    private $username;
    private $password;
    //private $email;
    //private $registrationDate;
    //private $role;

    // SETTERS
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setUsername(string $username) {
        $this->username = $username;
    }
    public function setPassword(int $password) {
        $this->password = $password;
    }
    public function setEmail(string $email) {
        $this->email = $email;
    }

    //GETTERS
    public function getId(): int {
        return $this->id;
    }
    public function getUsername(): string {
        return $this->username;
    }
    public function getPassword(): string {
        return $this->password;
    }
}
