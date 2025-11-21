<?php

class _202511210002_create_books_table
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
                CREATE TABLE books (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    description TEXT,
                    author VARCHAR(255) NOT NULL,
                    year INT NOT NULL,
                    user_id INT,
                    cover VARCHAR(255),
                    
                    CONSTRAINT fk_books_user_id_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
                )
            ";

            $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error creating 'books' table: " . $e->getMessage();
            return false;
        }
    }

    public function down(): bool
    {
        try {
            $sql = "DROP TABLE IF EXISTS books";
            $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error dropping 'books' table: " . $e->getMessage();
            return false;
        }
    }
}