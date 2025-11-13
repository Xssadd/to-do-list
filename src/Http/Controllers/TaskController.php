<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Router;
use App\Core\Validator;
use App\Task;

class TaskController extends Controller
{
    private Task $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index(): void
    {
        $tasks = $this->taskModel->all();

        $this->render('task/index', compact('tasks'));
    }

    public function create(): void
    {
        $errors = [];
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $this->render('task/create-form', compact('errors'));
    }

    public function store()
    {
        if (!Validator::string($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Title is required';
            Router::redirect('/add');
        }

        $data['title'] = trim($_POST['title']);
        $data['description'] = trim($_POST['description'] ?? '');
        $this->taskModel->create($data);

        Router::redirect('/');
    }

    public function edit(int $id): void
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            Router::abort();
        }

        $errors = [];
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $this->render('task/edit-form', compact('task', 'errors'));
    }

    public function update(): void
    {
        $id = $_POST['id'];
        if (!Validator::string($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Title is required';
            Router::redirect('/edit/{$id}');
        }

        $task = $this->taskModel->find($id);

        if (!$task) {
            Router::abort();
        }

        $data['title'] = trim($_POST['title']);
        $data['description'] = trim($_POST['description'] ?? '');
        $data['status'] = $_POST['status'];
        $this->taskModel->update($id, $data);

        Router::redirect('/');
    }

    public function delete(): void
    {
        $this->taskModel->delete($_POST['id']);
        Router::redirect('/');
    }
}