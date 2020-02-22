<?php
namespace App\Controller;

use App\Manager\AdminManager;

class AdminController
{
    public function displayAdminPanel() {
        require 'src/view/adminView.php';
    }

    public function displayLoginAdminPanel() {
        //header('Location: /admin');
        //var_dump($_SERVER['PATH_INFO']);
        if(isset($_POST['send_data'])) {
            $adminName = $_POST['admin_name'];
            $adminManager = new AdminManager();
            $user = $adminManager->login($adminName);

            if ($user['role'] === "admin") {
                //header('Location: index.php?action=post&post_id=' . $relatedId);
                header('Location: /admin');
            } else {
                echo "You are not an admin !";
            }
            require 'src/view/adminLoginView.php';
        } else {
            require 'src/view/adminLoginView.php';
        }
    }
}