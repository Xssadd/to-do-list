<?php
namespace APP\Core;

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

    public function any(string $uri, $action): void
    {
        $this->addRoute(['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'], $uri, $action);
    }

    private function addRoute(array $methods, string $uri, $action): void
    {
        $uri = preg_replace('#\{([^/]+)\}#', '([^/]+)', $uri);
        $uri = "#^" . $uri . "$#";

        $this->routes[] = [
            'methods' => $methods,
            'uri' => $uri,
            'action'  => $action,
        ];
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
        http_response_code(404);
        echo "404 Not Found";
        return null;
    }
}