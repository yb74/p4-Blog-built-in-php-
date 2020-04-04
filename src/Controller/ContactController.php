<?php
namespace App\Controller;

use App\Model\Contact;
use App\Manager\ContactManager;

class ContactController
{
    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    public function addMessage()
    {
        //$errors = [];

        $errors['fullname']="";
        $errors['email']= "";
        $errors['message']="";
        $errors['form']="";
        $successMessage="Do you have any questions? Please do not hesitate to contact me directly. I will come back to you within a matter of hours to help you.";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['fullname']) && empty($_POST['email']) && empty($_POST['message'])) {
                $errors['form'] = "Please, fill in the form.";
            }
            elseif (empty($_POST['fullname'])) {
                $errors['form'] = "Please, enter your name.";
            }
            elseif (empty($_POST['email'])) {
                $errors['form'] = "Please, enter your email.";
            }
            elseif (empty($_POST['message'])) {
                $errors['form'] = "Please, enter a message.";
            }
            elseif (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['message'])) {
                $contact = new Contact();
                $contact->setFullname(htmlspecialchars($_POST['fullname']));
                $contact->setEmail(htmlspecialchars($_POST['email']));
                $contact->setMessage(htmlspecialchars($_POST['message']));
                $this->contactManager->createMessage($contact);

                $successMessage="Your message has been sent with success !";

                require "src/view/contactView.php";
                return;
            }
        }
        require "src/view/contactView.php";
    }
}