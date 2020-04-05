<?php

namespace App\Manager;

use App\Model\Contact;

class ContactManager extends Manager
{
    public function createMessage(Contact $contact)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO contacts(fullname, email, subject, message, contact_date) VALUES (:fullname, :email, :subject, :message, NOW())');
        $req->execute([
            'fullname' => $contact->getfullname(),
            'email' => $contact->getEmail(),
            'subject' => $contact->getSubject(),
            'message' => $contact->getMessage()
        ]);
        return $req;
    }
}