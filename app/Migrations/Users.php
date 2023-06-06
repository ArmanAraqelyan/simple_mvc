<?php

require_once './app/Database/DB.php';
use App\Database\DB;

class Users
{
    public function up(): void
    {
        $connection = DB::getInstance();
        $connection->exec("
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                data TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }

    public function down(): void
    {
        $connection = DB::getInstance();
        $connection->exec("DROP TABLE IF EXISTS users");
    }
}
