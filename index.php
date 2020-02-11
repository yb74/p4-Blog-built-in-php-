<?php
/*
 require('src/controller/frontend.php');
// require 'src/controller/PostController.php';
// require 'src/controller/CommentController.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                if (!empty($_POST['comment_author']) && !empty($_POST['comment_content'])) {
                    addComment($_GET['post_id'], $_POST['comment_author'], $_POST['comment_content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
*/

use blog\controller\FrontendController;
use blog\controller\BackendController;

require_once('controller/FrontendController.php');
require_once('controller/BackendController.php');

class Routeur
{
    private $FrontendController;
    private $BackendController;

    public function __construct()
    {
        $this->FrontendController = new FrontendController();
        $this->BackendController = new BackendController();
    }

    /**
     * Choose the action according to the request
     */
    public function routerRequete()
    {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'listPosts') {
                    $this->FrontendController->listPosts();
                } elseif ($_GET['action'] == 'post') {
                    $this->FrontendController->post();
                } elseif ($_GET['action'] == 'addComment') {
                    $this->FrontendController->addComment();
                } elseif ($_GET['action'] == 'reportComment') {
                    $this->FrontendController->reportComment();
                } elseif ($_GET['action'] == 'accountCreate') {
                    $this->FrontendController->accountcreate();
                } elseif ($_GET['action'] == 'login') {
                    $this->FrontendController->login();
                } elseif ($_GET['action'] == 'unlog') {
                    $this->FrontendController->unplug();
                }
            }
        }
        catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}