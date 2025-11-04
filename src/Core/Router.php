<?php
namespace App\Core;

use Exception;

class Router
{
    private array $routes = [];

    public function get(string $uri, $action): void
    {
        $this->addRoute(['GET'], $uri, $action);
    }

    public function post(string $uri, $action): void
    {
        $this->addRoute(['POST'], $uri, $action);
    }

    public function delete(string $uri, $action): void
    {
        $this->addRoute(['DELETE'], $uri, $action);
    }

    public function put(string $uri, $action): void
    {
        $this->addRoute(['PUT'], $uri, $action);
    }

    public function any(string $uri, $action): void
    {
        $this->addRoute(['GET', 'POST'], $uri, $action);
    }

    private function addRoute(array $methods, string $uri, $action): void
    {
        $uri = preg_replace('#\{([^/]+)\}#', '([^/]+)', $uri);
        $uri = "#^" . $uri . "$#";

        $this->routes[] = compact('methods', 'uri', 'action');
    }

    public function dispatch(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            if (in_array($method, $route['methods']) && preg_match($route['uri'], $uri, $matches)) {
                array_shift($matches);

                $action = $route['action'];

                // Если передан callback
                if (is_callable($action)) {
                    return call_user_func_array($action, $matches);
                }

                // Если контроллер указан в виде [Class, method]
                if (is_array($action) && count($action) === 2) {
                    [$class, $method] = $action;
                    $controller = new $class;
                    return call_user_func_array([$controller, $method], $matches);
                }

                throw new Exception("Неподдерживаемый тип action");
            }
        }

        // Если маршрут не найден
        $this->abort();
        return null;
    }

    public function abort($code = 404): void
    {
        http_response_code($code);
        View::render($code);
        die();
    }
}