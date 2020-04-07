<?php

namespace App\Model;

class Contact
{
    private $id;
    private $fullname;
    private $email;
    private $subject;
    private $message;
    private $contact_date;

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getContactDate()
    {
        return $this->contact_date;
    }

    // SETTERS
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function setContactDate($contact_date): void
    {
        $this->contact_date = $contact_date;
    }
}