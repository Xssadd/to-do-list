<?php

namespace App;

use App\Core\Controller;
use App\Core\Validator;

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

        $this->render('index', compact('tasks'));
    }

    public function create(): void
    {
        $errors = [];
        if(isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $this->render('create-form', compact('errors'));
    }

    public function store()
    {
        if (Validator::string($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Поле название обязательное';
            header("Location: /add");
            exit;
        }

        $data['title'] = trim($_POST['title']);
        $data['description'] = trim($_POST['description'] ?? '');
        $this->taskModel->create($data);

        header("Location: /");
        exit;
    }

    public function edit(int $id): void
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            http_response_code(404);
            $this->render('404');
            return;
        }

        $errors = [];
        if(isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $this->render('edit-form', compact('task', 'errors'));
    }

    public function update(): void
    {
        $id = $_POST['id'];
        if (Validator::string($_POST['title'])) {
            $_SESSION['errors']['title'] = 'Поле название обязательное';
            header("Location: /edit/{$id}");
            exit;
        }

        $task = $this->taskModel->find($id);

        if (!$task) {
            http_response_code(404);
            $this->render('404');
            return;
        }

        $data['title'] = trim($_POST['title']);
        $data['description'] = trim($_POST['description'] ?? '');
        $data['status'] = $_POST['status'];
        $this->taskModel->update($id, $data);

        header("Location: /");
        exit;
    }

    public function delete(): void
    {
        $this->taskModel->delete($_POST['id']);
        header("Location: /");
        exit;
    }
}