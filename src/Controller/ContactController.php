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


    /**
     * Function to send a message and create the body of the email sent
     */
    public function addMessage() {
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
                $contact = new Contact();
                $contact->setFullname(htmlspecialchars($_POST['fullname']));
                $contact->setEmail(htmlspecialchars($_POST['email']));
                $contact->setSubject(htmlspecialchars($_POST['subject']));
                $contact->setMessage(htmlspecialchars($_POST['message']));
                $this->contactManager->createMessage($contact);

                // configuration of the email to be send
                $header="MIME-Version: 1.0\r\n";
                $header.='From:"JeanForteroche.fr"<support@Jeanforteroche.fr>'."\n";
                $header.='Content-Type:text/html; charset="uft-8"'."\n";
                $header.='Content-Transfer-Encoding: 8bit';

                $subject = htmlspecialchars($_POST['subject']);
                // email body
                $message='
                    <html>
                        <body>
                            <div align="center">
                                <img src="/p4-Blog-built-in-php-/public/images/email/email_banner.jpg"/>
                                <br />
                                <u>Name of the sender : </u>'.htmlspecialchars($_POST['fullname']).'<br />
                                <u>Email of the sender : </u>'.htmlspecialchars($_POST['email']).'<br />
                                <br />
                                '.nl2br(htmlspecialchars($_POST['message'])).'
                                <br />
                                <img src="/p4-Blog-built-in-php-/public/images/email/email_separator.png"/>
                            </div>
                        </body>
                    </html>
                    ';

                // function mail() to send the email
                mail('jean.forteroche@jeanforteroche.webagencypro.fr', $subject, $message, $header);

                $successMessage="Your message has been sent with success !";

                require "src/view/contactView.php";
                return;
            }
        }
        require "src/view/contactView.php";
    }
}