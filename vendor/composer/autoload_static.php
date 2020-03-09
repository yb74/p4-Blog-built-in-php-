<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitab251815d9271268869eb849c34961ef
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Controller\\AdminController' => __DIR__ . '/../..' . '/src/Controller/AdminController.php',
        'App\\Controller\\CommentController' => __DIR__ . '/../..' . '/src/Controller/CommentController.php',
        'App\\Controller\\ContactController' => __DIR__ . '/../..' . '/src/Controller/ContactController.php',
        'App\\Controller\\PostController' => __DIR__ . '/../..' . '/src/Controller/PostController.php',
        'App\\Controller\\RegistrationController' => __DIR__ . '/../..' . '/src/Controller/RegistrationController.php',
        'App\\Controller\\UserController' => __DIR__ . '/../..' . '/src/Controller/UserController.php',
        'App\\Manager\\CommentManager' => __DIR__ . '/../..' . '/src/Manager/CommentManager.php',
        'App\\Manager\\Manager' => __DIR__ . '/../..' . '/src/Manager/Manager.php',
        'App\\Manager\\PostManager' => __DIR__ . '/../..' . '/src/Manager/PostManager.php',
        'App\\Manager\\RegistrationManager' => __DIR__ . '/../..' . '/src/Manager/RegistrationManager.php',
        'App\\Manager\\UserManager' => __DIR__ . '/../..' . '/src/Manager/UserManager.php',
        'App\\Model\\Admin' => __DIR__ . '/../..' . '/src/Model/Admin.php',
        'App\\Model\\Comment' => __DIR__ . '/../..' . '/src/Model/Comment.php',
        'App\\Model\\Post' => __DIR__ . '/../..' . '/src/Model/Post.php',
        'App\\Model\\User' => __DIR__ . '/../..' . '/src/Model/User.php',
        'App\\Router\\Route' => __DIR__ . '/../..' . '/src/Router/Route.php',
        'App\\Router\\Router' => __DIR__ . '/../..' . '/src/Router/Router.php',
        'App\\Router\\RouterException' => __DIR__ . '/../..' . '/src/Router/RouterException.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitab251815d9271268869eb849c34961ef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitab251815d9271268869eb849c34961ef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitab251815d9271268869eb849c34961ef::$classMap;

        }, null, ClassLoader::class);
    }
}
