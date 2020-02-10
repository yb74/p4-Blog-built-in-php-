<?php

namespace JeanForteroche\Blog\Model;

require_once("src/model/Manager.php");
// require_once("src/model/Comment.php");

class CommentManager extends Manager
{
    public function getComments($relatedPostId)// permet d'afficher tous les commentaires associés à l'ID du post en dessous du billet
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT comment_id, comment_author, comment_content, DATE_FORMAT(comment_date, \'Le %d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE related_post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($relatedPostId));

        return $comments;
    }

    public function postComment($relatedPostId, $commentAuthor, $commentContent) // permet d'afficher un nouveau commentaire en l'inserant dans la table
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(related_post_id, comment_author, comment_content, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($relatedPostId, $commentAuthor, $commentContent));

        return $affectedLines;
    }
}
