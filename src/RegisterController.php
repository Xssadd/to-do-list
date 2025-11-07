<?php

namespace App;

use App\Core\Controller;
use App\Core\Router;
use App\Core\Validator;

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

        $user = new User();
        $errors = [];

        if (!Validator::email($email)) {
            $errors['email'] = "Please enter a valid email address";
        }
        elseif ($user->findByEmail($email)) {
            $errors['email'] = "Email already exists";
        }

        if (!Validator::string($password, 6)) {
            $errors['password'] = "Please enter a password at least 6 characters";
        }

        if ($password != $repeatedPassword) {
            $errors['repeated-password'] = "Passwords do not match";
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            Router::redirect('/register');
        }

        $user->create($email, $password);

        $_SESSION['logged-in'] = true;
        $_SESSION['user']['email'] = $email;

        Router::redirect('/');
    }
}