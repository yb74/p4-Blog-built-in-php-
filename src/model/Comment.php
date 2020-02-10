<?php
class Comment {
    private $_comment_id;
    private $_related_post_id;
    private $_comment_author;
    private $_comment_content;
    private $_comment_date;

    // SETTERS
    public function setCommentId(int $commentId) {
        $this->_comment_id = $commentId;
    }
    public function setRelatedPostId(int $relatedPostId) {
        $this->_related_post_id = $relatedPostId;
    }
    public function setCommentAuthor(int $commentAuthor) {
        $this->_comment_author = $commentAuthor;
    }
    public function setCommentContent(int $commentContent) {
        $this->_comment_content = $commentContent;
    }
    public function setCommentDate(int $commentDate) {
        $this->_comment_date = $commentDate;
    }

    // GETTERS
    public function getCommentId(): int {
        return $this->_comment_id;
    }
    public function getRelatedPostId(): string  {
        return $this->_related_post_id;
    }
    public function getCommentAuthor(): string  {
        return $this->_comment_author;
    }
    public function getCommentContent(): string {
        return $this->_comment_content;
    }
    public function getCommentDate(): string {
        return $this->_comment_date;
    }
}