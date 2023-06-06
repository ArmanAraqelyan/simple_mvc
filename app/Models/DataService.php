<?php

namespace App\Models;

use PDO;

class DataService {
    public function __construct(
        private PDO $connection
    )
    {}

    public function insertData($data): string
    {
        $statement = $this->connection->prepare("INSERT INTO user (data) VALUES (?)");
        $statement->execute([$data]);
        return $this->connection->lastInsertId();
    }

    public function getData($id)
    {
        $statement = $this->connection->prepare("SELECT data FROM user WHERE id = ?");
        $statement->execute([$id]);
        return $statement->fetchColumn();
    }
}
