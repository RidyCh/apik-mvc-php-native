<?php

namespace App;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        $matchedRoute = null;
        foreach ($this->routes[$method] as $route => $controllerAction) {
            if (preg_match("~^$route$~", $uri, $matches)) {
                $matchedRoute = $controllerAction;
                break;
            }
        }

        if ($matchedRoute !== null) {
            $controller = $matchedRoute['controller'];
            $action = $matchedRoute['action'];

            $params = array_slice($matches, 1);

            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $action], $params);
        } else {
            header("Location: /halaman-tidak-ditemukan");
        }
    }
}