<?php

const BASE_PATH = __DIR__ . '/../src';

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\TaskController;
use App\Core\Router;

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$router = new Router();

$router->get('/', [TaskController::class, 'index']);
$router->get('/add', [TaskController::class, 'create']);
$router->post('/add', [TaskController::class, 'store']);
$router->get('/edit/{id}', [TaskController::class, 'edit']);
$router->post('/edit', [TaskController::class, 'update']);
$router->delete('/delete', [TaskController::class, 'delete']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->dispatch($method, $uri);
} catch (Exception $e) {
    $router->abort();
}