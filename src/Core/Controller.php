<?php

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $params = [])
    {
       View::render($view, $params);
    }

}