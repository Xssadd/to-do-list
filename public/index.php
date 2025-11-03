<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\TaskController;
use App\Core\Router;

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$router = new Router();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->get('/', [TaskController::class, 'index']);
$router->any('/add', [TaskController::class, 'create']);
$router->any('/edit/{id}', [TaskController::class, 'edit']);
$router->delete('/delete/{id}', [TaskController::class, 'delete']);

try {
    $router->dispatch($method, $uri);
} catch (Exception $e) {
    http_response_code(404);
}