<?php
namespace App\Model;

class Comment {
    private $id;
    private $related_id;
    private $author;
    private $content;
    private $comment_date_fr;
    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getComment_date_fr()
    {
        return $this->comment_date_fr;
    }

    /**
     * @param mixed $comment_date_fr
     */
    public function setComment_date_fr($comment_date_fr): void
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

    /*
    // SETTERS
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setRelated_id(int $related_id) {
        $this->related_id = $related_id;
    }
    public function setAuthor(string $author) {
        $this->author = $author;
    }
    public function setContent(string $content) {
        $this->content = $content;
    }
    public function setComment_date_fr(string $comment_date_fr) {
        $this->comment_date_fr = $comment_date_fr;
    }
    public function setStatus(bool $status) {
        $this->status = $status;
    }

    // GETTERS
    public function getId(): int {
        return $this->id;
    }
    public function getRelated_id(): string  {
        return $this->related_id;
    }
    public function getAuthor(): string  {
        return $this->author;
    }
    public function getContent(): string {
        return $this->content;
    }
    public function getCreation_date(): string {
        return $this->comment_date_fr;
    }
    public function getStatus(): bool {
        return $this->status;
    }
    */
}