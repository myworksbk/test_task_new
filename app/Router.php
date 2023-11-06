<?php

namespace App;

class Router
{
    private $routes = [];

    public function load($routeFile): self
    {
        $this->routes = $this->routes = include_once $routeFile;

        return $this;
    }

    public function dispatch(): void
    {
        $fullUrl = $_SERVER['REQUEST_URI'];
        $urlParts = parse_url($fullUrl);
        $urlPath = $urlParts['path'];

        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $path => $route) {
            if ($urlPath === $path && $method === $route['method']) {
                $this->applyMiddleware($route);

                $this->runControllerAction($route);

                return;
            }
        }

        $this->responseNotFound();
    }

    private function applyMiddleware(array $route): void
    {
        if (!isset($route['middleware'])) {
            return;
        }
        
        foreach ($route['middleware'] as $middleware) {
            $middleware = 'App\Middleware\\' . $middleware;

            if (class_exists($middleware)) {
                $middlewareInstance = new $middleware();

                $middlewareInstance->handle();
            }
        }
    }

    private function runControllerAction(array $route): void
    {
        list($controller, $action) = explode('@', $route['controller']);

        $controller = 'App\Controllers\\' . $controller;

        if (class_exists($controller)) {
            $controllerInstance = new $controller();

            $controllerInstance->$action();
        }
    }

    private function responseNotFound(): void
    {
        http_response_code(404);

        echo "404 Not Found";
    }
}
