<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\TaskController;

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlArray = explode('/', trim($urlPath, '/'));

$action = $urlArray[0] ?? 'index';
$id = $_GET['id'] ?? null;

$controller  = new TaskController();

match ($action) {
    'add' => $controller->create(),
    'edit' => $id ? $controller->edit($id) : http_response_code(400),
    'delete' => $id ? $controller->delete($id) : http_response_code(400),
    default => $controller->index(),
};
