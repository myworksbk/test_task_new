<?php

namespace App;

interface DatabaseInterface
{
    public static function connect(): self;
    public function execute($sql, $params = []);
    public function insert($table, $data);
    public function update($table, $data, $where);
    public function delete($table, $where);
}