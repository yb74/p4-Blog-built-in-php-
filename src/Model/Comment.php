<?php
namespace App\Model;

class Comment {
    private $id;
    private $related_id;
    private $author;
    private $content;
    private $comment_date_fr;
    private $status;


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getRelatedId()
    {
        return $this->related_id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCommentDateFr()
    {
        return $this->comment_date_fr;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // SETTERS
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setRelatedId($related_id): void
    {
        $this->related_id = $related_id;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setCommentDateFr($comment_date_fr): void
    {
        $this->comment_date_fr = $comment_date_fr;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }
}