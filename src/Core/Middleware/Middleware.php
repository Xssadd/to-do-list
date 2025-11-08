<?php

namespace App\Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve($key) {
        if (!$key) {
            return null;
        }

        if (!array_key_exists($key, self::MAP)) {
            throw new \Exception("Middleware key '$key' not found");
        }

        $middleware = static::MAP[$key];

        (new $middleware)->handle();
    }
}