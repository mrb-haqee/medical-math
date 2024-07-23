<?php

namespace Database;

class Database
{
    public static function connect($DATA_ENV)
    {
        try {
            $dsn = "mysql:host=" . $DATA_ENV["DB_HOST"] . ";port=" . $DATA_ENV["DB_PORT"] . ";charset=utf8;dbname=" . $DATA_ENV["DB_NAME"];
            $pdo = new \PDO($dsn, $DATA_ENV["DB_USERNAME"], $DATA_ENV["DB_PASSWORD"]);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // echo "sukses konek";
            return $pdo;
        } catch (\PDOException $e) {
            die("Database connection failed: \n" . $e->getMessage());
        }
    }
}
