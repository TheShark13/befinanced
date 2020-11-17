<?php

namespace MySqlCommunicator\Database;

use PDO;

class DatabaseConnection
{
    private static ?PDO $dbConnection = null;

    public static function getConnection(): PDO {
        if(!self::$dbConnection) {
            self::$dbConnection = new PDO("mysql:dbname=befinanced;host=127.0.0.1", "root");
            self::$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$dbConnection;
    }
}