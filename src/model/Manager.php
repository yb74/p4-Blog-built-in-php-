<?php

namespace JeanForteroche\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '');
        return $db; // renvoie la connection
    }
}