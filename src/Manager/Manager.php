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
    /*protected function dbConnect()
    {
        $db = new \PDO('mysql:host=db5000345698.hosting-data.io;dbname=dbs336157;charset=utf8', 'dbu387808', '0622178800-Yb');
        return $db; // renvoie la connection
    }*/
}