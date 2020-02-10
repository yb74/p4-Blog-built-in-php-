<?php

// Chargement des classes
require_once('src/model/PostManager.php');
require_once('src/model/CommentManager.php');

function listPosts()
{
    $postManager = new JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('src/view/listPostsView.php');
}

function post()
{
    $postManager = new JeanForteroche\Blog\Model\PostManager();
    $commentManager = new JeanForteroche\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['post_id']);
    $comments = $commentManager->getComments($_GET['post_id']);

    require('src/view/postView.php');
}

function addComment($relatedPostId, $commentAuthor, $commentContent)
{
    $commentManager = new JeanForteroche\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($relatedPostId, $commentAuthor, $commentContent);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&post_id=' . $relatedPostId);
    }
}