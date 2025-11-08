<?php
namespace App\Core;

use App\Core\Middleware\Middleware;
use Exception;

class Router
{
    private array $routes = [];

    private static array $uriNames = [];

    public function get(string $uri, $action)
    {
        return $this->addRoute(['GET'], $uri, $action);
    }

    public function post(string $uri, $action)
    {
        return $this->addRoute(['POST'], $uri, $action);
    }

    public function delete(string $uri, $action)
    {
        return $this->addRoute(['DELETE'], $uri, $action);
    }

    public function put(string $uri, $action)
    {
        return $this->addRoute(['PUT'], $uri, $action);
    }

    public function any(string $uri, $action)
    {
        return $this->addRoute(['GET', 'POST'], $uri, $action);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function name($name)
    {
        self::$uriNames[$name] = $this->routes[array_key_last($this->routes)]['uri'];

        return $this;
    }

    public static function url($name, $params = [])
    {
        $uri = self::$uriNames[$name];
        $query = [];

        foreach ($params as $key => $value) {
            $placeholder = '{' . $key . '}';
            if (str_contains($uri, $placeholder)) {
                $uri = str_replace($placeholder, $value, $uri);
            }
            else {
                $query[$key] = $value;
            }
        }


        if (!empty($query)) {
            $uri .= '?' . http_build_query($query);
        }

        return $uri;
    }

    private function addRoute(array $methods, string $uri, $action)
    {
        $uriPreg = "#^" . preg_replace('#\{([^/]+)}#', '([^/]+)', $uri) . "$#";

        $this->routes[] = compact('methods', 'uri', 'uriPreg', 'action');

        return $this;
    }

    public function dispatch(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            if (in_array($method, $route['methods']) && preg_match($route['uriPreg'], $uri, $matches)) {

                if (isset($route['middleware'])) {
                    Middleware::resolve($route['middleware']);
                }

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
        static::abort();
        return null;
    }

    public static function abort($code = 404): void
    {
        http_response_code($code);
        View::render($code);
        exit;
    }

    public static function redirect(string $uri, int $code = 302): void
    {
        header("Location: " . $uri);
        exit;
    }
}