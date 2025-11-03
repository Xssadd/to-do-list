<?php

namespace App;

use App\Core\Controller;

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
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['title'] = trim($_POST['title']);
            $data['description'] = trim($_POST['description'] ?? '');
            $this->taskModel->create($data);

            header("Location: index.php");
            exit;
        }

        $this->render('form');
    }

    public function edit(int $id): void
    {
        $task = $this->taskModel->find($id);

        if(!$task) {
            http_response_code(404);
            echo "Task not found";
            return;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['title'] = trim($_POST['title']);
            $data['description'] = trim($_POST['description'] ?? '');
            $data['status'] = $_POST['status'];
            $this->taskModel->update($id, $data);

            header("Location: index.php");
            exit;
        }

        $this->render('form', compact('task'));
    }

    public function delete($id): void
    {
        $this->taskModel->delete($id);
        header("Location: index.php");
        exit;
    }
}