<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Controller\{
    PostController,
    CommentController,
    RegistrationController
};
/*
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

$router = new App\Router\Router($_SERVER['REQUEST_URI']);

$router->get('/admin', "Admin#displayAdminPanel");
$router->get('/adminLogin', "Admin#displayLoginAdminPanel");
$router->post('/admin/:', "Admin#displayAdminPanel")->with('relatedId', '[0-9]+');; // Comment an article

$router->get('/', "Post#listPosts"); // display the list of articles/posts
$router->get('/post/:postId', "Post#post")->with('postId', '[0-9]+'); // display the selected article/post
$router->post('/post/:postId', "Comment#addComment")->with('relatedId', '[0-9]+');; // Comment an article

/*
$router->get('/posts', function() { echo 'Tous les articles'; });
$router->get('/article/:slug-:id/:page', "Posts#show")->with('id', '[0-9]+')->with('page', '[0-9]+')->with('slug', '[a-z\-0-9]+');
$router->get('/article/:slug-:id', "Posts#show")->with('id', '[0-9]+')->with('slug', '[a-z\-0-9]+');
//$router->get('/posts/:id', "Posts#show"); // post controller et action show
$router->post('/posts/:id', function($id) { echo 'Poster pour l\'article' . $id . '<pre>' . print_r($_POST, true) . '</pre>'; });
*/

$router->run(); // fonction servant à vérifier si l'url tappé en paramètre correspond à un des urls