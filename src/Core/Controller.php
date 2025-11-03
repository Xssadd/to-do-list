<?php

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $params = [])
    {
        extract($params);
        ob_start();
        include __DIR__. '/../templates/' . $view . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../templates/layout.php';
    }

}