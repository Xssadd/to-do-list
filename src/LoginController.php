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
            }
        }

        $_SESSION['error'] = "Wrong credentials";
        Router::redirect('/login');
    }

    public function logout()
    {
        $_SESSION = [];

        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        session_destroy();

        Router::redirect('/');
    }
}