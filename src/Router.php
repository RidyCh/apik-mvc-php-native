<?php

namespace App;

class Router
{
    private $routes = [];

    public function get($uri, $controller, $method, $middleware = null)
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'action' => $method,
            'middleware' => $middleware
        ];
    }

    public function post($uri, $controller, $method, $middleware = null)
    {
        $this->routes['POST'][$uri] = [
            'controller' => $controller,
            'action' => $method,
            'middleware' => $middleware
        ];
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        $matchedRoute = null;
        $params = [];

        foreach ($this->routes[$method] as $route => $controllerAction) {
            if (preg_match("~^$route$~", $uri, $matches)) {
                $matchedRoute = $controllerAction;
                $params = array_slice($matches, 1);
                break;
            }
        }

        if ($matchedRoute !== null) {
            $controller = $matchedRoute['controller'];
            $action = $matchedRoute['action'];
            $middleware = $matchedRoute['middleware'] ?? null;

            if ($middleware !== null) {
                if (is_callable([$middleware, 'handle'])) {
                    $middlewareInstance = new $middleware();
                    $middlewareInstance->handle();
                } elseif (is_callable($middleware)) {
                    call_user_func($middleware);
                }
            }

            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $action], $params);
        } else {
            Helpers::redirect('/not-found');
        }
    }
}
