<?php
namespace App\Manager;

class Manager
{
    // LOCAL DATABASE
    protected function dbConnect() // Connection to the database
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_database;charset=utf8', 'root', '');
        return $db;
    }

    // ONLINE DATABASE
//    protected function dbConnect()
//    {
//        $db = new \PDO('mysql:host=db5000367838.hosting-data.io;dbname=dbs356130;charset=utf8', 'dbu123930', '0622178800-Yb');
//        return $db;
//    }
}