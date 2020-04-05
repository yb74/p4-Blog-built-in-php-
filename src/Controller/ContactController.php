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

    public function addMessage() {

// Le message
        $message = "Line 1\r\nLine 2\r\nLine 3";

// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
        $message = wordwrap($message, 70, "\r\n");

// Envoi du mail
        mail('jean.forteroche@jeanforteroche.webagencypro.fr', 'CONTACT - jeanforteroche.webagencypro.fr', $message);


        //$errors = [];

        $errors['fullname']="";
        $errors['email']= "";
        $errors['subject']= "";
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
            elseif (empty($_POST['subject'])) {
                $errors['form'] = "Please, enter a subject.";
            }
            elseif (empty($_POST['message'])) {
                $errors['form'] = "Please, enter a message.";
            }
            elseif (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['message'])) {
//                $contact = new Contact();
//                $contact->setFullname(htmlspecialchars($_POST['fullname']));
//                $contact->setEmail(htmlspecialchars($_POST['email']));
//                $contact->setSubject(htmlspecialchars($_POST['subject']));
//                $contact->setMessage(htmlspecialchars($_POST['message']));
//                $this->contactManager->createMessage($contact);

                $header="MIME-Version: 1.0\r\n";
                // $header.='From:"JeanForteroche.fr"<support@Jeanforteroche.fr>'."\n";
                $header.='Content-Type:text/html; charset="uft-8"'."\n";
                $header.='Content-Transfer-Encoding: 8bit';

                $subject = htmlspecialchars($_POST['subject']);
                $message='
                    <html>
                        <body>
                            <div align="center">
                                <img src="http://www.primfx.com/mailing/banniere.png"/>
                                <br />
                                <u>Sender\s name :</u>'.htmlspecialchars($_POST['fullname']).'<br />
                                <u>Sender\s email :</u>'.htmlspecialchars($_POST['email']).'<br />
                                <br />
                                '.nl2br(htmlspecialchars($_POST['message'])).'
                                <br />
                                <img src="http://www.primfx.com/mailing/separation.png"/>
                            </div>
                        </body>
                    </html>
                    ';

                mail('jean.forteroche@jeanforteroche.webagencypro.fr', $subject, $message, $header);

                $successMessage="Your message has been sent with success !";

                require "src/view/contactView.php";
                return;
            }
        }
        require "src/view/contactView.php";
    }
}