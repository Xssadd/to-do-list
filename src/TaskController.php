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
        $error = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(Validator::string($_POST['title'])) {
                $error['title'] = 'Поле название обязательное';
            }

            if(empty($error)) {
                $data['title'] = trim($_POST['title']);
                $data['description'] = trim($_POST['description'] ?? '');
                $this->taskModel->create($data);

                header("Location: /");
                exit;
            }
        }

        $this->render('form', compact('error'));
    }

    public function edit(int $id): void
    {
        $task = $this->taskModel->find($id);
        $error = [];

        if(!$task) {
            http_response_code(404);
            echo "Задача не найдена";
            return;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(Validator::string($_POST['title'])) {
                $error['title'] = 'Поле название обязательное';
            }

            if(empty($error)) {
                $data['title'] = trim($_POST['title']);
                $data['description'] = trim($_POST['description'] ?? '');
                $data['status'] = $_POST['status'];
                $this->taskModel->update($id, $data);

                header("Location: /");
                exit;
            }
        }

        $this->render('form', compact('task', 'error'));
    }

    public function delete(): void
    {
        $this->taskModel->delete($_POST['id']);
        header("Location: /");
        exit;
    }
}