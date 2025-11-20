<?php

class ReviewRepository extends Repository
{
    private static ?ReviewRepository $instance = null;

    private function __construct()
    {
        parent::__construct();
    }

    public static function getInstance(): ReviewRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function findAll(): array
    {
        $stmt = $this->connection->query("
            SELECT 
                id,
                review_text AS reviewText,
                rating,
                user_id as userId,
                book_id as bookId
            FROM reviews
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Review::class);

        return $stmt->fetchAll();
    }

    function findById(int $id): ?object
    {
        $stmt = $this->connection->prepare("
            SELECT 
                id,
                review_text AS reviewText,
                rating,
                user_id as userId,
                book_id as bookId
            FROM reviews
            WHERE id = :id
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Review::class);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    function findByBook(int $bookId): array
    {
        $stmt = $this->connection->prepare("
            SELECT 
                id,
                review_text AS reviewText,
                rating,
                user_id as userId,
                book_id as bookId
            FROM reviews
            WHERE book_id = :bookId
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Review::class);
        $stmt->execute(['bookId' => $bookId]);

        return $stmt->fetchAll();
    }

    function create(array $data): bool
    {
        $stmt = $this->connection->prepare("
            INSERT INTO reviews (review_text, rating, user_id, book_id) 
            VALUES (:review_text, :rating, :user_id, :book_id)
        ");

        $stmt->execute([
            'review_text' => $data['review_text'],
            'rating' => $data['rating'],
            'user_id' => $data['user_id'],
            'book_id' => $data['book_id']
        ]);

        return $stmt->rowCount() > 0;
    }
}