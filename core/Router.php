<?php

namespace core;

use core\Middleware\Auth;
use core\Middleware\Guest;
use core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($uri, $method, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];
        return $this;
    }

    public function get($uri, $controller)
    {
      return $this->add($uri, "GET", $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add($uri, "POST", $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add($uri, "PATCH", $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add($uri,"DELETE", $controller);
    }

    public function put($uri, $controller)
    {
       return $this->add($uri, "PUT", $controller);
    }

    public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function route($uri,$method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                return require base_path('Http/controllers/'.$route['controller']);
            }
        }
        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
