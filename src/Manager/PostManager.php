<?php

namespace App\Manager;

use App\Model\Post;

class PostManager extends Manager
{
    /**
     * Function to get the total number of pages
     */
    public function getTotal() // get total number of pages
    {
        $db = $this->dbConnect();
        $req = (int)$db->query('SELECT COUNT(id) FROM posts')->fetch($db::FETCH_NUM)[0];

        return $req;
    }

    /**
     * Function to get all posts
     */
    public function getPosts($perPage, $offset)
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, '%d/%m/%Y at %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT $offset, $perPage");
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $posts = $req->fetchAll();
        return $posts;
    }

    /**
     * Function to get a specific post
     */
    public function getPost($postId) // get the selected post
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, \'%d/%m/%Y at %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $post = $req->fetch();

        return $post;
    }

    // ADMIN
    /**
     * Function to get all posts from the dashboard
     */
    public function getDashboardPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, '%d/%m/%Y at %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 15");
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $posts = $req->fetchAll();
        return $posts;
    }

    /**
     * Function to create a post
     */
    public function addPost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date, picture_url) VALUES(:title, :content, NOW(), :picture_url)');
        $req->execute(array(
            'title'=> $post->getTitle(),
            'content'=> $post->getContent(),
            'picture_url'=> $post->getPictureUrl()
        ));

        return $req;
    }

    /**
     * Function to update a post
     */
    public function updatePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :title, content = :content, creation_date = NOW() WHERE id = :id ORDER BY creation_date DESC');
        $req->execute(array(
            'title'=> $post->getTitle(),
            'content'=> $post->getContent(),
            'id'=> $post->getId()
        ));

        return $req;
    }

    /**
     * Function to delete a post
     */
    public function deletePost(Post $post){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');
        $req->execute(array(
            'id'=> $post->getId()
        ));
        return $req;
    }
}
