<?php
namespace App\Manager;

use App\Model\Comment;

class CommentManager extends Manager
{
    /**
     * Get all comments on a post
     */
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, status, DATE_FORMAT(creation_date, \'%d/%m/%Y at %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE related_id = ? ORDER BY creation_date DESC LIMIT 50 OFFSET 0');
        $req->execute(array($postId));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    /**
     * Get all reported comments
     */
    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, content, related_id, status, DATE_FORMAT(creation_date, \'%d/%m/%Y at %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE status = 1 ORDER BY creation_date DESC LIMIT 50 OFFSET 0');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Model\Comment');
        $comments = $req->fetchAll();

        return $comments;
    }

    /**
     * Create a comment on a specific post
     */
    public function postComment(Comment $comment)
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

    /**
     * Function to report a comment
     */
    public function updateCommentStatus(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 1 WHERE id = :id');
        $req->execute([
            'id'=> $comment->getId()
        ]);
        return $req;
    }

    /**
     * Function to create a redirection after reporting a comment
     */
    public function getCommentRelatedId(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT related_id FROM comments WHERE id = :id');
        $req->execute([
            'id' => $comment->getId()
        ]);
        $comment = $req->fetch();
        return $comment;
    }

    /**
     * Function to delete a reported comment
     */
    public function deleteComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = :id');
        $req->execute([
            'id'=> $comment->getId()
        ]);
        return $req;
    }

    /**
     * Function to cancel the comment report
     */
    public function unreportComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET status = 0 WHERE id = :id');
        $req->execute([
            'id'=> $comment->getId()
        ]);
        return $req;
    }
}
