<?php
//require_once __DIR__ . "/vendor/autoload.php";

/*use App\controller\{
    PostController,
    CommentController
};*/
require_once 'src/controller/CommentController.php';
require_once 'src/controller/PostController.php';
//try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'post') {
            $post = new PostController();
            $post->post();
        } elseif ($_GET['action'] == 'addComment') {
            $comment = new CommentController();
            $comment->addComment($_GET['post_id'], $_POST['comment_author'], $_POST['comment_content']);
        }
    } else {
        $post = new PostController();
        $post->listPosts();
    }
/*}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}*/