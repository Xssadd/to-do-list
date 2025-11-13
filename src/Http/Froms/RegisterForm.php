<?php

namespace App\Http\Forms;

use App\Core\Validator;

class RegisterForm
{
    private array $errors = [];

    public function validate($email, $password, $repeatedPassword): bool
    {
        if (!Validator::email($email)) {
            $this->errors['email'] = "Please enter a valid email address";
        }

        if (!Validator::string($password, 6)) {
            $this->errors['password'] = "Please enter a password at least 6 characters";
        }

        if ($password != $repeatedPassword) {
            $this->errors['repeated-password'] = "Passwords do not match";
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

}