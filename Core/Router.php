<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function add($route, $ctrl, $func)
    {
        $this->routes[$route]['ctrl']= $ctrl;
        $this->routes[$route]['func']= $func;
    }

    public function match($url)
    {
        if (array_key_exists($url, $this->routes))
        {
            return true;
        }
        return false;
    }

    public function dispatch($url)
    {
        if ($this->match($url)) {
            $controller = $this->routes[$url]['ctrl'];
            $controller = '\Controllers\\' . $controller;
            $controller_object = new $controller();
            $action = $this->routes[$url]['func'];
            $controller_object->$action();
        } else {
            http_response_code(404); die();
        }
    }
}
