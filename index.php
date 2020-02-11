<?php
require_once "vendor/autoload.php";

use App\controller\{
    PostController,
    CommentController
};
//require_once 'src/controller/CommentController.php';
//require_once('src/controller/PostController.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'post') {
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                $post = new PostController();
                $post->post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                if (!empty($_POST['comment_author']) && !empty($_POST['comment_content'])) {
                    $comment = new CommentController();
                    $comment->addComment($_GET['post_id'], $_POST['comment_author'], $_POST['comment_content']);
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
        $post = new PostController();
        $post->listPosts();
    }
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}