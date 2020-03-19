<?php
namespace App\Model;

class Comment {
    private $id;
    private $related_id;
    private $author;
    private $content;
    private $comment_date_fr;
    private $status;
    private $nb_comments;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRelatedId()
    {
        return $this->related_id;
    }

    /**
     * @param mixed $related_id
     */
    public function setRelatedId($related_id): void
    {
        $this->related_id = $related_id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCommentDateFr()
    {
        return $this->comment_date_fr;
    }

    /**
     * @param mixed $comment_date_fr
     */
    public function setCommentDateFr($comment_date_fr): void
    {
        $this->comment_date_fr = $comment_date_fr;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getNbComments()
    {
        return $this->nb_comments;
    }

    /**
     * @param mixed $nb_comments
     */
    public function setNbComments($nb_comments): void
    {
        $this->nb_comments = $nb_comments;
    }
}