<?php

class _202511210003_create_reviews_table
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
                CREATE TABLE reviews (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    review_text TEXT,
                    rating INT NOT NULL,
                    user_id INT NOT NULL,
                    book_id INT NOT NULL,
                    
                    CONSTRAINT fk_reviews_user_id_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
                    CONSTRAINT fk_reviews_book_id_books FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE
                )
            ";

            $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error creating 'reviews' table: " . $e->getMessage();
            return false;
        }
    }

    public function down(): bool
    {
        try {
            $sql = "DROP TABLE IF EXISTS reviews";
            $this->pdo->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error dropping 'reviews' table: " . $e->getMessage();
            return false;
        }
    }
}