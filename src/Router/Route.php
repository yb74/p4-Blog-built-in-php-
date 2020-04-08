<?php
namespace App\Router;

class Route
{
    private $path;
    private $callable;  // contains the controller function to be called
    private $matches = []; // contains the list of elements to be compared to check if they match
    private $params = []; // contains the list of parameters

    public function __construct($path, $callable)
    {
        $this->path = trim($path, '/'); // here we remove the usless "/"
        $this->callable = $callable;
    }

    /**
     * Function to set parameters and regex
     */
    public function with($param, $regex) {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this; // $this is return so that we can chain several methods
    }

    /**
     * Function which Allows to catch the url with its parameters and check if they match with the path
     */
    public function match($url) {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url,$matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * Function to check if a parameter match
     */
    private function paramMatch($match) {
        if(isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * Function used to call a function of the controller (the action)
     */
    public function call() {
        if (is_string($this->callable)) {
            $params = explode('#', $this->callable);
            $controller = "App\\Controller\\" . $params[0] . "Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
            $action = $params[1];
            return $controller->$action();
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    /**
     * Function to get the url
     */
    public function getUrl($params) {
        $path = $this->path;
        foreach($params as $k => $v) {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }
}
