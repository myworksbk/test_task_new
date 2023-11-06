<?php

namespace App;

use App\DatabaseInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    private const CONFIG_FILE = ROOT_PATH . '/configs/database.php';

    private static $instance;
    private $pdo;

    private function __construct($config)
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['database']}",
                $config['username'],
                $config['password']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function connect(): self
    {
        if (self::$instance === null) {
            $config = require_once self::CONFIG_FILE;

            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($params);

            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function insert($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        $this->execute($sql, $data);

        return $this->pdo->lastInsertId();
    }

    public function update($table, $data, $where, $params = [])
    {
        $setInsert = [];

        foreach ($data as $key => $value) {
            $setInsert[] = "$key = :$key";
        }

        $insertClause = implode(', ', $setInsert);

        $setWhere = [];

        foreach ($where as $key => $value) {
            $setWhere[] = "$key = :$key";
        }

        $whereClause = implode(', ', $setWhere);

        $sql = "UPDATE $table SET $insertClause WHERE $whereClause";

        $params = array_merge($data, $where, $params);

        $stmt = $this->execute($sql, $params);

        return $stmt->rowCount();
    }

    public function delete($table, $where, $params = [])
    {
        $setWhere = [];

        foreach ($where as $key => $value) {
            $setWhere[] = "$key = :$key";
        }

        $whereClause = implode(', ', $setWhere);

        $sql = "DELETE FROM $table WHERE $whereClause";

        $params = array_merge($where, $params);

        $stmt = $this->execute($sql, $params);
        
        return $stmt->rowCount();
    }
}
