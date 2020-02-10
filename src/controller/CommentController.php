<?php
require_once 'src/model/CommentManager.php';
class CommentController {
    public function addComment($relatedPostId, $commentAuthor, $commentContent)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($relatedPostId, $commentAuthor, $commentContent);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&post_id=' . $relatedPostId);
        }
    }
}