<?php

namespace App\Manager;

class PostManager extends Manager
{
    public function getTotal() // get total number of pages
    {
        $db = $this->dbConnect();
        $req = (int)$db->query('SELECT COUNT(post_id) FROM posts')->fetch($db::FETCH_NUM)[0];

        return $req;
    }

    public function getPosts($perPage, $offset) // get all posts
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT post_id, post_title, post_content, post_picture, DATE_FORMAT(post_date, 'Le %d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY post_date DESC LIMIT $offset, $perPage");

        $req;
    }

    public function getPost($postId) // get the selected post
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post_id, post_title, post_content, post_picture, DATE_FORMAT(post_date, \'Le %d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE post_id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $post = $req->fetch();// recupére chaque ligne de la requête donc ici les posts

        return $post;
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
