<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Router;
use App\Http\Forms\RegisterForm;
use App\User;

class RegisterController extends Controller
{
    public function index()
    {
        $errors = [];
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        return $this->render('register', compact('errors'));
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatedPassword = $_POST['repeated-password'];

        $form = new RegisterForm();

        if (!$form->validate($email, $password, $repeatedPassword)) {
            $_SESSION['errors'] = $form->errors();
            Router::redirect('/register');
        }

        $user = new User();

        if ($user->findByEmail($email)) {
            $_SESSION['errors']['email'] = "Email already exists";
            Router::redirect('/register');
        }

        $user->create($email, $password);

        $_SESSION['logged-in'] = true;
        $_SESSION['user']['email'] = $email;

        Router::redirect('/');
    }
}