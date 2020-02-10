<?php
require_once 'src/model/PostManager.php';
class PostController {
    public function listPosts()
    {
        $postManager = new PostManager(); // Creation obj
        $posts = $postManager->getPosts();

        require('view/frontend/listPostsView.php');
    }

    public function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['post_id']);
        $comments = $commentManager->getComments($_GET['post_id']);

        require('view/frontend/postView.php');
    }
}
