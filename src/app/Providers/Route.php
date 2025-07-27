<?php

namespace App\Providers;

class Route
{
    protected static array $routes = [];

    public static function get(string $path, callable|array $action): void
    {
        self::addRoutes("GET", $path, $action);
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function post(string $path, callable|array $action): void
    {
        self::addRoutes("POST", $path, $action);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected static function addRoutes(string $method, string $path, callable|array $action): void
    {
        self::$routes[$method][$path] = $action;
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $action = self::$routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 NOT FOUND.";
            return;
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            if (class_exists($controller) && method_exists($controller, $method)) {
                (new $controller)->$method();
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
