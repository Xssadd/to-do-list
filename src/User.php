<?php

namespace App;

use App\Core\Model;

class User extends Model
{
    public function findByEmail(string $email) : ?array
    {
        $stmt = $this->db->prepare("Select * from users where email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetch() ?: null;
    }

    public function findById(int $id) : ?array
    {
        $stmt = $this->db->prepare("Select * from users where id = :id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function create(string $email, string $password) : bool
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return true;
    }
}