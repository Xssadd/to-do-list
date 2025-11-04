<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $params = []): void
    {
        extract($params);
        ob_start();
        include BASE_PATH . '/view/' . $view . '.php';
        $content = ob_get_clean();
        include BASE_PATH . '/view/layout.php';
    }
}