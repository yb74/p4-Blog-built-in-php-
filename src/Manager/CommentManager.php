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
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    public function getAllComments()// permet d'afficher tous les commentaires associés à l'ID du post en dessous du billet
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, content, related_id, status, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY creation_date DESC LIMIT 50 OFFSET 0');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    /*public function selectReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, content, related_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE status = 1 ORDER BY creation_date DESC LIMIT 5 OFFSET 0');
        $req->execute();

        return $req;
    }*/

    public function postComment(Comment $comment) // permet d'afficher un nouveau commentaire en l'inserant dans la table
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(related_id, author, content, status, creation_date) VALUES(:related_id, :author, :content, 0, NOW())');
        $req->execute(array(
            'related_id' => $comment->getRelatedId(),
            'author' => $comment->getAuthor(),
            'content' => $comment->getContent()
        ));

        return $req;
    }

    /*public function getCommentsAdmin()// permet d'afficher tous les commentaires associés à l'ID du post en dessous du billet
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, content, DATE_FORMAT(creation_date, \'Le %d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY creation_date DESC');
        $comments->execute();

        return $comments;
    }*/

    public function getNbCommentAdmin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(comments.id) AS nb_comments, posts.title AS title, posts.content AS postContent, posts.picture_url as picture_url, posts.id AS post_id, posts.creation_date AS post_date FROM comments
            INNER JOIN posts ON comments.related_id = posts.id
            GROUP BY comments.related_id');
        $comments = $req->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Comment');
        return $comments;
    }

    /*public function getNbCommentAdmin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(comments.id) AS nb_comments, comments.related_id FROM comments
            INNER JOIN posts ON comments.related_id = posts.id
            GROUP BY comments.related_id');
        $comments = $req->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Comment');
        return $comments;
    }*/

    public function statusComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 1 WHERE id = ?');
        $newStatus = $req->execute($commentId);

        return $newStatus;
    }

    public function updateStatusComment($commentId)
    {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 1 WHERE id = ?');
        $newStatus = $req->execute([$commentId]);
//        var_dump($newStatus);
        return $newStatus;
    }

    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $deleteComment = $db->prepare('DELETE FROM comments WHERE id = ?');
        $deleteComment->execute([$commentId]);
    }
}
