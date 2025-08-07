<?php

namespace App\Providers;

use App\Http\Exceptions\RouteNotFoundException;

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
            throw new RouteNotFoundException();
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            if (class_exists($controller) && method_exists($controller, $method)) {
                (new $controller)->$method();
                return;
            }
        } else if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        throw new RouteNotFoundException();
    }
}
