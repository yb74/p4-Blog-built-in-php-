<?php
namespace App\Router;

class RouterException extends \Exception
{
    public function displayError() {
        try {
            throw new Exception('You are not an admin !');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}