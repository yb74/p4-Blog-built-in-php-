<?php
namespace App\Controller;

use App\Model\{
    Post,
    Comment
};
use App\Manager\{
    PostManager,
    CommentManager
};

class PostController
{
    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }


    /**
     * Function to get all posts on the main page
     */
    public function listPosts()
    {
        $posts = $this->postManager->getPosts();
        require('src/view/listPostsView.php');
    }


    /**
     * Function to comment a post and show a specific post
     */
    public function post($postId)
    {
        $errors['form']="";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['author']) && empty($_POST['content'])) {
                $errors['form']="please, fill in the form.";
            }
            if (empty($_POST['author'])) {
                $errors['form'] = "Please, enter your username.";
            }
            if (empty($_POST['content'])) {
                $errors['form'] = "Please, enter a comment.";
            }
            else {
                $comment = new Comment();
                $comment->setAuthor(htmlspecialchars($_POST['author']));
                $comment->setContent(htmlspecialchars($_POST['content']));
                $comment->setRelatedId($postId);
                $this->commentManager->postComment($comment);

                header('Location: /chapter' . $postId);
            }
        }

        $post  = $this->postManager->getPost($postId);
        $comments  = $this->commentManager->getComments($postId);

        require('src/view/postView.php');
    }
}
