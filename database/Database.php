<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '3306';
        $user = getenv('DB_USERNAME') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        $dbname = getenv('DB_DATABASE') ?: 'bookwise';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4;";

        try {
            $this->connection = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            throw new RuntimeException("Error connecting to database: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
