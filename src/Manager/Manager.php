<?php
namespace App\Manager;

class Manager
{
    // LOCAL DATABASE
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '');
        return $db; // renvoie la connection
    }

    // ONLINE DATABASE
//    protected function dbConnect()
//    {
//        $db = new \PDO('mysql:host=db5000360491.hosting-data.io;dbname=dbs349951;charset=utf8', 'dbu113871', '0622178800-Yb');
//        return $db; // renvoie la connection
//    }
}