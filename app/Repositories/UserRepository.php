<?php

namespace App\Repositories;

use PDO;

final class UserRepository extends AbstractRepository
{
    public function getAllUsersWithPosition(): array
    {
        $sql = "
            SELECT users.*, positions.title AS position, positions.id AS position_id
            FROM users
            JOIN positions ON positions.id = users.position_id
        ";

        return $this->database->execute($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser(array $data): int
    {
        return $this->database->insert('users', $data);
    }

    public function updateUser(int $id, array $data): mixed
    {
        return $this->database->update('users', $data, ['id' => $id]);
    }

    public function deleteUser(int $id): mixed
    {
        return $this->database->delete('users', ['id' => $id]);
    }
}
