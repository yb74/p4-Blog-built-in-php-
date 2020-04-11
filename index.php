<?php
session_start();

require_once __DIR__ . "/vendor/autoload.php";

$router = new App\Router\Router($_SERVER['REQUEST_URI'] ?? "/"); // instantiation of the router

// Structure of a route : first, the REQUEST_METHOD is set (post or get) and it takes the path and and a callable as parameters.
// The callable is composed of the controller that should be used and the function to call separated with an "#" sign.
// then you have the option to us the with() function to set a GET superglobal or a slug with it's REGEX)

// DISPLAY ERROR
    $router->get('/error', "Admin#displayError"); // display error

// POSTS AND COMMENTS
    $router->get('/', "Post#listPosts"); // display all chapters
    $router->get('/chapter:postId', "Post#post")->with('postId', '[0-9]+'); // display the selected chapter

// logout
    $router->get('/logout', "User#logOut");

// CONTACT SYSTEM
    $router->get('/contact', "Contact#addMessage"); // display the contact form
    $router->post('/contact', "Contact#addMessage"); // send a message (contact)

    if (!empty($_SESSION)) {
        $router->post('/chapter:postId', "Post#post")->with('postId', '[0-9]+'); // Comment a chapter
        if(($_SESSION['role']) == 'admin') {
            // ADMIN SYSTEM
            $router->get('/admin', "Admin#manageDashboard"); // display the admin panel

// posts management
            $router->get('/createPost', "Admin#createPost"); // access to the post creation view
            $router->post('/createPost', "Admin#createPost"); // submit a new post

            $router->get('/modifyPost:postId', "Admin#modifyPost")->with('postId', '[0-9]+'); // Access to the view to modify a post
            $router->post('/modifyPost:postId', "Admin#modifyPost")->with('postId', '[0-9]+'); // update a post
            $router->get('/deletePost:postId', "Admin#postDelete")->with('postId', '[0-9]+'); // delete a post

//comments management
            $router->get('/manageComments', "Admin#manageComments"); // access to the comment management view
            $router->get('/deleteComment:commentId', "Admin#commentDelete")->with('commentId', '[0-9]+'); // delete a post
            $router->get('/unreportComment:commentId', "Admin#commentUnreport")->with('commentId', '[0-9]+'); // unreport a post

//users management
            $router->get('/manageUsers', "Admin#manageUsers"); // access to the users management view
            $router->get('/deleteUser:userId', "Admin#userDelete")->with('userId', '[0-9]+'); // delete a user
        }
        if (($_SESSION['role']) == 'user') {
            $router->get('/reportComment:commentId', "Comment#reportComment")->with('commentId', '[0-9]+'); // Report a comment
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

try {
    $router->run(); // This function is used to run the route if all the conditions are complied (if the route match the url)
}
catch (Exception $e) {
    echo $e; // if there is a problem with the route, an exception is thrown to display the error
}