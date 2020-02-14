<?php
namespace App\Controller;

use App\Manager\CommentManager;

class CommentController {
    public function addComment($relatedId, $author, $content)
    {
        if (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
            if (!empty($_POST['comment_author']) && !empty($_POST['comment_content'])) {
                $commentManager = new CommentManager();
                $affectedLines = $commentManager->postComment($relatedId, $author, $content);

                if ($affectedLines === false) {
                    throw new Exception('Impossible d\'ajouter le commentaire !');
                } else {
                    header('Location: index.php?action=post&post_id=' . $relatedId);
                }
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }
}