<?php

namespace App\Repositories;

use PDO;

final class PositionRepository extends AbstractRepository
{
    public function getAllPositions(): array
    {
        $sql = "SELECT * FROM positions";

        return $this->database->execute($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
