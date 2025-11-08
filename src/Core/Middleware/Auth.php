<?php

namespace App\Core\Middleware;

use App\Core\Router;

class Auth
{
    public function handle()
    {
        if (!isset($_SESSION['user'])){
            Router::redirect('/');
        }
    }
}