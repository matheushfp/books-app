<?php
class _202511210001_create_users_table
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function up(): bool
    {
        try {
            $sql = "
                CREATE TABLE users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    password_hash VARCHAR(255) NOT NULL
                )
            ";

            $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error creating 'users' table: " . $e->getMessage();
            return false;
        }
    }

    public function down(): bool
    {
        try {
            $sql = "DROP TABLE IF EXISTS users";
            $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error dropping 'users' table: " . $e->getMessage();
            return false;
        }
    }
}