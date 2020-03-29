<?php
session_start();

require_once __DIR__ . "/vendor/autoload.php";

use App\Controller\{
    PostController,
    CommentController,
    UserController,
    AdminController,
    ContactController
};

use App\Router\RouterException;

$router = new App\Router\Router($_SERVER['PATH_INFO'] ?? "/");

try{
    // DISPLAY ERROR
    $router->get('/error', "Admin#displayError"); // display error

// POSTS AND COMMENTS
    $router->get('/', "Post#listPosts"); // display all chapters

    $router->get('/chapter:postId', "Post#post")->with('postId', '[0-9]+'); // display the selected chapter

// CONTACT SYSTEM
    $router->get('/contact', "Contact#displayContactForm"); // display the contact form
    if (!empty($_SESSION)) {
        // logout
        $router->get('/logout', "User#logOut");

        if(($_SESSION['role']) == 'admin') {
            // ADMIN SYSTEM

            $router->get('/admin', "Admin#manageDashboard"); // display the admin panel

// posts management
            $router->get('/createPost', "Admin#createPost"); // access to the post creation view
            $router->post('/createPost', "Admin#createPost"); // access to the post creation view

            $router->get('/modifyPost:postId', "Admin#modifyPost")->with('postId', '[0-9]+'); // Access to the view to modify a post
            $router->post('/modifyPost:postId', "Admin#modifyPost")->with('postId', '[0-9]+'); // update a post
            $router->get('/deletePost:postId', "Admin#postDelete")->with('postId', '[0-9]+'); // delete a post

//comments management
            $router->get('/manageComments', "Admin#manageComments"); // access to the comment management view
            $router->get('/deleteComment:commentId', "Admin#commentDelete")->with('commentId', '[0-9]+'); // delete a post
            $router->get('/unreportComment:commentId', "Admin#commentUnreport")->with('commentId', '[0-9]+'); // unreport a post

//users management
            $router->get('/manageUsers', "Admin#manageUsers"); // access to the users management view
            $router->get('/deleteUser:userId', "Admin#userDelete")->with('userId', '[0-9]+'); // delete a post
        }
        elseif (($_SESSION['role']) == 'user') {
            $router->post('/chapter:postId', "Post#post")->with('postId', '[0-9]+'); // Comment a chapter
            $router->get('/reportComment:commentId', "Comment#commentReport")->with('commentId', '[0-9]+'); // Report a comment
        }
    }
    else {
        // USER SYSTEM
// registration
        $router->get('/registration', "User#userRegister");
        $router->post('/registration', "User#userRegister");
// connection
        $router->get('/connection', "User#userAuth");
        $router->post('/connection', "User#userAuth");
    }
}
catch (Exception $e) {
    // displayError($e->getMessage());
    echo "You are not allowed to visit this page !";
}



/*
$router->get('/article/:slug-:id/:page', "Posts#show")->with('id', '[0-9]+')->with('page', '[0-9]+')->with('slug', '[a-z\-0-9]+');
*/

$router->run(); // fonction servant à vérifier si l'url tappé en paramètre correspond à un des urls