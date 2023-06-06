<?php

namespace App\Database;

use PDO;

final class DB extends PDO
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO(
                'mysql:host=127.0.0.1;port=3307;dbname=mvc_example',
                'root',
                '1111',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return self::$instance;
    }
}
