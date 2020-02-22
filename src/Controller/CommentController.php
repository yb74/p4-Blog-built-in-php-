<?php
namespace App\Controller;

use App\Manager\CommentManager;

class CommentController {
    public function addComment($relatedId)
    {
            if (!empty($_POST['comment_author']) && !empty($_POST['comment_content'])) {
                $author = $_POST['comment_author'];
                $content = $_POST['comment_content'];
                $commentManager = new CommentManager();
                $commentManager->postComment($relatedId, $author, $content);

                header('Location: /post/' . $relatedId);
            } else {
                echo 'Tous les champs ne sont pas remplis !';
            }
    }
}