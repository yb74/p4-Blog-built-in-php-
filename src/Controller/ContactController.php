<?php
namespace App\Controller;

class ContactController
{
    public function displayContactForm() {
        require "src/view/contactView.php";
    }
}