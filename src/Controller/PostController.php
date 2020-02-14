<?php
namespace App\Controller;

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

    public function post()
    {
        if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($_GET['post_id']);
            $comments = $commentManager->getComments($_GET['post_id']);
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

        require('src/view/postView.php');
    }
}
