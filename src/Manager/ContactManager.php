<?php

namespace App\Manager;

use App\Model\Contact;

class ContactManager extends Manager
{
    public function createMessage(Contact $contact)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO contacts(fullname, email, message, contact_date) VALUES (:fullname, :email, :message, NOW())');
        $req->execute([
            'fullname' => $contact->getfullname(),
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage()
        ]);
        return $req;
    }
}