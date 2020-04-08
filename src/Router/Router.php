<?php
namespace App\Router;

class Router
{
    private $url; // contains the url where we want to go
    private $routes = []; // contains the list of the routes
    private $namedRoutes = []; // contains the list of the named routes

    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * Function to set a GET superglobal straight in the route
     */
    public function get($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * Function to set a POST superglobal straight in the route
     */
    public function post($path, $callable, $name = null) {
         return $this->add($path, $callable, $name, 'POST');
    }
    // NB : if we need to use a GET and a POST, we have to create 2 different routes:
    //  one route which starts with the function get() (when the use of GET is required)
    // one another route which starts with the function post() when information are sent through a form for instance

    /**
     * Function that generate a route
     */
    public function add($path, $callable, $name, $method) {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null) {
            $name = $callable;
        }
        if($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     * Function which runs the route after checking if it matches the url
     */
    public function run() {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new \Exception('REQUEST_METHOD does not exist');
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new \Exception('No matching routes');
    }

    /**
     * Function to check if the name of a route matches
     */
    public function url($name, $params = []) {
        if(!isset($this->namedRoutes[$name])) {
            throw new \Exception('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
}
