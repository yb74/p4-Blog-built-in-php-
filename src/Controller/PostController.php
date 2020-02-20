<?php
namespace App\Controller;

/*class PostsController {
    public function show($slug, $id, $page) {
        echo "Je suis l'article $id, et je suis en page  " . $page;
    }
}*/

use App\Manager\{
    PostManager,
    CommentManager
};

class PostController {
    public function listPosts()
    {
        $postManager = new PostManager(); // Creation obj

        $posts = $postManager->getPosts();

        require('src/view/listPostsView.php');
    }

    public function post($postId)
    {
        //if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $comments = $commentManager->getComments($postId);
        /*} else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }*/

        require('src/view/postView.php');
    }
}
