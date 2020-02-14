<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Controller\{
    PostController,
    CommentController,
    RegistrationController
};

//try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'post') {
            $post = new PostController();
            $post->post();
        } elseif ($_GET['action'] == 'addComment') {
            $comment = new CommentController();
            $comment->addComment($_GET['post_id'], $_POST['comment_author'], $_POST['comment_content']);
        }  elseif ($_GET['action'] == 'addNewUser') {
            $user = new RegistrationController();
            $user->addNewUser($_POST['username'], $_POST['password']);
        }
    } else {
        $post = new PostController();
        $post->listPosts();
    }
/*}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}*/