<?php

namespace App\Core\Middleware;

use App\Core\Router;

class Guest
{
    public function handle()
    {
        if (isset($_SESSION['user'])){
            Router::redirect('/');
        }
    }
}