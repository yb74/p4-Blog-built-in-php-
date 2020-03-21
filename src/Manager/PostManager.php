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
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $deletePost = $db->prepare('DELETE FROM posts WHERE id = ?');
        $deletePost->execute(array($postId));
    }


    public function postComment(Comment $comment) // permet d'afficher un nouveau commentaire en l'inserant dans la table
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(related_id, author, content, status, creation_date) VALUES(:related_id, :author, :content, 0, NOW())');
        $req->execute(array(
            'related_id'=> $comment->getRelatedId(),
            'author'=> $comment->getAuthor(),
            'content'=> $comment->getContent()
        ));

        return $req;
    }
}
