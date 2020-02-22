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

    public function listPosts($page)
    {
        $postManager = new PostManager(); // Creation obj

        $posts = $postManager->getPosts();

        // Pagination :
        $totalArticleNumber = $postManager->getNumberPage();
        $currentPage = (int)($page ?? 1);
        if($currentPage <= 0) {
            throw new Exception('Numéro de page invalide !');
        }
        var_dump($currentPage);

        require('src/view/listPostsView.php');
    }

    public function post($postId)
    {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $comments = $commentManager->getComments($postId);

        require('src/view/postView.php');
    }
}
