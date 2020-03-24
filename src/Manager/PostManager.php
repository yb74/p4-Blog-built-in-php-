<?php

namespace App\Manager;

use App\Model\Post;

class PostManager extends Manager
{
    public function getTotal() // get total number of pages
    {
        $db = $this->dbConnect();
        $req = (int)$db->query('SELECT COUNT(id) FROM posts')->fetch($db::FETCH_NUM)[0];

        return $req;
    }

    public function getPosts($perPage, $offset) // get all posts
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT $offset, $perPage");
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $posts = $req->fetchAll();
        return $posts;
    }

    public function getPost($postId) // get the selected post
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $post = $req->fetch();// recupére chaque ligne de la requête donc ici les posts

        return $post;
    }

    // ADMIN

    public function getDashboardPosts() // get all posts for the dashboard
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 15");
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $posts = $req->fetchAll();
        return $posts;
    }

    // CREATE a post
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

    // UPDATE a post
    public function updatePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
        $req->execute(array(
            'title'=> $post->getTitle(),
            'content'=> $post->getContent(),
            'id'=> $post->getId()
        ));

        return $req;
    }

    // DELETE a post
    public function deletePost(Post $post){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');
        $req->execute(array(
            'id'=> $post->getId()
        ));
        return $req;
    }
}
