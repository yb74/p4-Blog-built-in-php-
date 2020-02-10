<?php
class Comment {
    private int $id;
    private int $relatedId;
    private string $author;
    private string $content;
    private string $date;

    // SETTERS
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setRelatedId(int $relatedId) {
        $this->relatedId = $relatedId;
    }
    public function setAuthor(int $author) {
        $this->author = $author;
    }
    public function setContent(int $content) {
        $this->content = $content;
    }
    public function setDate(int $date) {
        $this->date = $date;
    }

    // GETTERS
    public function getId(): int {
        return $this->id;
    }
    public function getRelatedId(): string  {
        return $this->relatedId;
    }
    public function getAuthor(): string  {
        return $this->author;
    }
    public function getCommentContent(): string {
        return $this->content;
    }
    public function getCommentDate(): string {
        return $this->date;
    }
}