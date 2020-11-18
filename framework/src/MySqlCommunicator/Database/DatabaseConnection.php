<?php

namespace MySqlCommunicator\Database;

use PDO;

class DatabaseConnection
{
    private static ?PDO $dbConnection = null;

    public static function getConnection(): PDO
    {
        if (!self::$dbConnection) {
            self::$dbConnection = new PDO($_ENV['DATABASE_DSN'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
            self::$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$dbConnection;
    }
}