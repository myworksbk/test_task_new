<?php

namespace App\Repositories;

use App\Database;
use App\DatabaseInterface;

abstract class AbstractRepository
{
    protected ?DatabaseInterface $database;

    public function __construct(?DatabaseInterface $database = null) {
        $this->database = $database;

        if ($this->database === null) {
            $this->database = Database::connect();
        }
    }
}
