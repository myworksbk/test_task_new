<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

final class UserService
{
    public function __construct(private UserRepository $repository) {}

    public function getAllUsersWithPosition(): array
    {
        return $this->repository->getAllUsersWithPosition();
    }

    public function createUser(array $data): int
    {
        unset($data['id']);

        return $this->repository->createUser($data);
    }

    public function updateUser(array $data): int
    {
        if (!isset($data["id"]) || !$data['id']) {
            $this->errorId();
        }

        $id = $data['id'];

        unset($data['id']);

        return $this->repository->updateUser($id, $data);
    }

    public function deleteUser(?int $id): int
    {
        if (!$id) {
            $this->errorId();
        }

        return $this->repository->deleteUser($id);
    }

    private function errorId(): void
    {
        throw new Exception("Error. The id must be pressent.");
    }
}