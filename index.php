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

//require dirname(__DIR__) . "vendor/autoload.php";
var_dump($_SERVER);

echo "Salut, je suis un fichier php";