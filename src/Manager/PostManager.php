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

    // admin
    public function getAdminPosts() // get all posts in dashboard
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, picture_url, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 15");
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            'App\Model\Post');
        $posts = $req->fetchAll();
        return $posts;
    }

    /*
    // UPDATE a post
    public function updatePost($title, $content, $postId)
    {
        $db = $this->dbConnect();
        $updatePost = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $updatePost->execute(array($title, $content, $postId));
    }
    // DELETE a post
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $deletePost = $db->prepare('DELETE FROM p4_posts WHERE post_id = ?');
        $deletePost->execute(array($postId));
    }
    */
}
