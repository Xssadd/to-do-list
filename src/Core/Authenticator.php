<?php

namespace App\Core;

use App\User;

class Authenticator
{
    public function attempt($email, $password): bool
    {
        $userModel = new User();

        if ($user = $userModel->findByEmail($email)) {
            if (password_verify($password, $user['password'])) {
                $this->login($email);
                return true;
            }
        }

        return false;
    }

    public function login($email): void
    {
        $_SESSION['user'] = [
            'email' => $email,
        ];
        $_SESSION['logged-in'] = true;
        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $_SESSION = [];

        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        session_destroy();
    }
}