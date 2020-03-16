<?php
namespace App\Manager;

use App\Model\Comment;

class CommentManager extends Manager
{
    public function getComments($postId)// permet d'afficher tous les commentaires associés à l'ID du post en dessous du billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, status, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE related_id = ? ORDER BY creation_date DESC LIMIT 5 OFFSET 0');
        $req->execute(array($postId));
        $req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    /*public function selectReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, content, related_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE status = 1 ORDER BY creation_date DESC LIMIT 5 OFFSET 0');
        $req->execute();

        return $req;
    }

    public function statusComment($commentId, $related_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 1 WHERE id = ? AND related_id = ?');
        $newStatus = $req->execute($commentId, $related_id);

        return $newStatus;
    }*/

    public function postComment(Comment $comment) // permet d'afficher un nouveau commentaire en l'inserant dans la table
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(related_id, author, content, status, creation_date) VALUES(:related_id, :author, :content, 0, NOW())');
        $req->execute(array(
            'related_id'=> $comment->getRelatedId(),
            'author'=> $comment->getAuthor(),
            'content'=> $comment->getContent()
        ));

        return $req;
    }

    /*public function getCommentsAdmin()// permet d'afficher tous les commentaires associés à l'ID du post en dessous du billet
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, content, DATE_FORMAT(creation_date, \'Le %d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY creation_date DESC');
        $comments->execute();

        return $comments;
    }

    public function getNbComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
        $comments->execute([$postId]);
        $nbComments = $comments->fetch();
        return $nbComments;
    }*/
}
