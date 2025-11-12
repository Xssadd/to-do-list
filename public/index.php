<?php

session_start();

const BASE_PATH = __DIR__ . '/../src';

require_once __DIR__ . '/../vendor/autoload.php';

use App\LoginController;
use App\RegisterController;
use App\TaskController;
use App\Core\Router;

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$router = new Router();

$router->get('/', [TaskController::class, 'index'])->name('task.list');
$router->get('/add', [TaskController::class, 'create'])->name('task.create');
$router->post('/add', [TaskController::class, 'store'])->name('task.store');
$router->get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
$router->post('/edit', [TaskController::class, 'update'])->name('task.update');
$router->delete('/delete', [TaskController::class, 'delete'])->name('task.delete');

$router->get('/login', [LoginController::class, 'index'])->only('guest');
$router->post('/login', [LoginController::class, 'login'])->only('guest');

$router->get('/register', [RegisterController::class, 'index'])->only('guest');
$router->post('/register', [RegisterController::class, 'store'])->only('guest');

$router->get('/logout', [LoginController::class, 'logout'])->only('auth');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->dispatch($method, $uri);
} catch (Exception $e) {
    Router::abort();
}