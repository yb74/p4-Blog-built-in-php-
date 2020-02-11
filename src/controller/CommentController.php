<?php
namespace App\controller;

use App\model\CommentManager;

//require_once 'src/model/CommentManager.php';

class CommentController {
    public function addComment($relatedId, $author, $content)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($relatedId, $author, $content);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&post_id=' . $relatedId);
        }
    }
}