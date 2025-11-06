<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $params = [])
    {
        extract($params);
        ob_start();
        require BASE_PATH . '/view/' . $view . '.php';
        $content = ob_get_clean();
        require BASE_PATH . '/view/layout.php';
    }
}