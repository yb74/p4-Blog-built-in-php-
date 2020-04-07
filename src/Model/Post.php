<?php
namespace App\Model;

class Post {
    private $id;
    private $title;
    private $content;
    private $creation_date_fr;
    private $picture_url;

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreationDateFr()
    {
        return $this->creation_date_fr;
    }

    public function getPictureUrl()
    {
        return $this->picture_url;
    }

    // SETTERS
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setCreationDateFr($creation_date_fr): void
    {
        $this->creation_date_fr = $creation_date_fr;
    }

    public function setPictureUrl($picture_url): void
    {
        $this->picture_url = $picture_url;
    }
}