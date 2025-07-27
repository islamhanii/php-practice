<?php

namespace App\Http\Services;

class RouteServiceProvider
{
    protected array $routes = [];

    public function get(string $path, callable|array $action): void
    {
        $this->addRoutes("GET", $path, $action);
    }

    /*----------------------------------------------------------------------------------------------*/

    public function post(string $path, callable|array $action): void
    {
        $this->addRoutes("POST", $path, $action);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function addRoutes(string $method, string $path, callable|array $action): void
    {
        $this->routes[$method][$path] = $action;
    }

    /*----------------------------------------------------------------------------------------------*/

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 NOT FOUND.";
            return;
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            if (class_exists($controller) && method_exists($controller, $method)) {
                (new $controller)->$method;
            } else {
                http_response_code(500);
                echo "Controller or method not found.";
            }
        } else if (is_callable($action)) {
            call_user_func($action);
        } else {
            http_response_code(500);
            echo "Invalid route handler.";
        }
    }
}
