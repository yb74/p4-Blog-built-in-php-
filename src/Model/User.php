<?php
namespace App\Model;

class User
{
    private $id;
    private $username;
    private $password;
    private $registrationDate;
    private $role;

    // Constructor
    /*public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    // Method hydratation
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function valideUsername()
    {
        return !empty($this->username);
    }*/

    // SETTERS
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setUsername(string $username) {
        $this->username = $username;
    }
    public function setPassword(string $password) {
        $this->password = $password;
    }
    public function setRegistrationDate(string $registrationDate) {
        $this->registrationDate = $registrationDate;
    }
    public function setRole(string $role) {
        $this->role = $role;
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
    public function getRegistrationDate(): string {
        return $this->registrationDate;
    }
    public function getRole(): string {
        return $this->role;
    }
}
