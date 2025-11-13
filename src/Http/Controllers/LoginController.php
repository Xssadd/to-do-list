<?php

namespace App\Http\Controllers;

use App\Core\Authenticator;
use App\Core\Controller;
use App\Core\Router;

class LoginController extends Controller
{
    private Authenticator $auth;

    public function __construct()
    {
        $this->auth = new Authenticator();
    }

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
        if ($this->auth->attempt($_POST['email'], $_POST['password'])) {
            Router::redirect('/');
        }

        $_SESSION['error'] = "Wrong credentials";
        Router::redirect('/login');
    }

    public function logout()
    {
        $this->auth->logout();

        Router::redirect('/');
    }
}