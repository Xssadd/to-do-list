<?php

namespace App;

use App\Core\Model;

class Task extends Model
{
    public function all() : array
    {
        return $this->db->query('SELECT * FROM tasks ORDER BY created_at DESC')->fetchAll();
    }

    public function find(int $id) : ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare('INSERT INTO tasks (title, description) VALUES (:title, :description)');
        $stmt->execute(['title' => $data['title'], 'description' => $data['description']]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare('UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id');
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}