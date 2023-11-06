<?php

namespace App\Services;

use App\Repositories\PositionRepository;

final class PositionService
{
    public function __construct(private PositionRepository $repository) {}

    public function getAllPositions(): array
    {
        return $this->repository->getAllPositions();
    }
}