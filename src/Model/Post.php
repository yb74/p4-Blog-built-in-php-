<?php
namespace App\Model;

class Post {
    private $id;
    private $title;
    private $content;
    private $creation_date_fr;
    private $picture_url;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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
    public function getCreationDateFr()
    {
        return $this->creation_date_fr;
    }

    /**
     * @param mixed $creation_date_fr
     */
    public function setCreationDateFr($creation_date_fr): void
    {
        $this->creation_date_fr = $creation_date_fr;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl()
    {
        return $this->picture_url;
    }

    /**
     * @param mixed $picture_url
     */
    public function setPictureUrl($picture_url): void
    {
        $this->picture_url = $picture_url;
    }

}