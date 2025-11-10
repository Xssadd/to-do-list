<?php

namespace App;

use App\Core\Controller;
use App\Core\Router;
use App\Core\Validator;

class LoginController extends Controller
{
    public function index()
    {
        $errors = '';
        if (isset($_SESSION['error'])) {
            $errors = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $this->render('login', compact('errors'));
    }

    public function login()
    {
        $email = $_POST['email'];
        $user = new User();

        if ($user = $user->findByEmail($email)) {
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user['email'];
                $_SESSION['logged-in'] = true;
                Router::redirect('/');
            } else {
                $_SESSION['error'] = "Wrong credentials";
            }
        }
        else {
            $_SESSION['error'] = "User not found";
        }

        Router::redirect('/login');
    }
}