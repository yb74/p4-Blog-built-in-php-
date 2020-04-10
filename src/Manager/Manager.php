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
//        $db = new \PDO('mysql:host=db5000366659.hosting-data.io;dbname=dbs355182;charset=utf8', 'dbu477943', '0622178800-Yb');
//        return $db;
//    }
}