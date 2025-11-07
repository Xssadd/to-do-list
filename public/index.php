<?php

session_start();

const BASE_PATH = __DIR__ . '/../src';

require_once __DIR__ . '/../vendor/autoload.php';

use App\RegisterController;
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

$router->get('/register', [RegisterController::class, 'index']);
$router->post('/register', [RegisterController::class, 'store']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->dispatch($method, $uri);
} catch (Exception $e) {
    Router::abort();
}