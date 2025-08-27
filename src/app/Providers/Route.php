<?php

namespace App\Providers;

use App\Http\Exceptions\RouteNotFoundException;

class Route
{
    protected static array $routes = [];

    public function __call($name, $arguments)
    {
        $name .= 'Internal';
        if (!method_exists($this, $name)) {
            throw new \BadMethodCallException("Method $name does not exist on " . static::class);
        }

        return $this->$name(...$arguments);
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function __callStatic($name, $arguments)
    {
        $instance = new static();
        $name .= 'Internal';
        if (!method_exists($instance, $name)) {
            throw new \BadMethodCallException("Method $name does not exist on " . static::class);
        }

        return $instance->$name(...$arguments);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function getInternal(string $path, callable|array $action): void
    {
        $this->addRoute("GET", $path, $action);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function postInternal(string $path, callable|array $action): void
    {
        $this->addRoute("POST", $path, $action);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function addRoute(string $method, string $path, callable|array $action): void
    {
        $pattern = preg_replace('#\{([^}]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = "#^" . rtrim($pattern, '/') . "$#";

        self::$routes[$method][] = [
            'path' => $path,
            'pattern' => $pattern,
            'action' => $action
        ];
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function dispatchInternal(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $routes = self::$routes[$method] ?? [];

        foreach ($routes as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, fn($k) => !is_int($k), ARRAY_FILTER_USE_KEY);

                $action = $route['action'];

                if (is_array($action)) {
                    [$controller, $method] = $action;
                    if (class_exists($controller) && method_exists($controller, $method)) {
                        (new $controller)->$method(...$params);
                        return;
                    }
                } elseif (is_callable($action)) {
                    call_user_func_array($action, $params);
                    return;
                }

                throw new RouteNotFoundException("Controller or method not found");
            }
        }

        throw new RouteNotFoundException("Route [$uri] not found");
    }
}
