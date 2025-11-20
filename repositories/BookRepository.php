<?php

class BookRepository extends Repository
{
    private static ?BookRepository $instance = null;

    private function __construct()
    {
        parent::__construct();
    }

    public static function getInstance(): BookRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function findAll($titleFilter = ''): array
    {
        $stmt = $this->connection->prepare("
            SELECT b.*, b.user_id AS userId, round(avg(r.rating)) AS avgRating, count(r.rating) AS reviewsCount
            FROM books b
            LEFT JOIN reviews r ON b.id = r.book_id
            WHERE b.title LIKE :titleFilter
            GROUP BY b.id
            ORDER BY b.title ASC
        ");
        $stmt->execute(['titleFilter' => "%$titleFilter%"]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);
    }

    function findById(int $id): ?object
    {
        $stmt= $this->connection->prepare("
            SELECT b.*, b.user_id AS userId, round(avg(r.rating)) AS avgRating, count(r.rating) AS reviewsCount
            FROM books b
            LEFT JOIN reviews r ON b.id = r.book_id
            WHERE b.id = :id
            GROUP BY b.id
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Book::class);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    function findByUser(int $userId): array
    {
        $stmt= $this->connection->prepare("
            SELECT 
	            b.*, b.user_id AS userId, 
	            IFNULL(ROUND(AVG(r.rating)), 0) AS avgRating,
	            COUNT(r.rating) AS reviewsCount
            FROM books b
            LEFT JOIN reviews r ON b.id = r.book_id
            WHERE b.user_id  = :userId
            GROUP BY b.id
        ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Book::class);
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetchAll();
    }

    function create(array $data): bool
    {
        $stmt = $this->connection->prepare("
            INSERT INTO books (title, description, author, year, user_id) 
            VALUES (:title, :description, :author, :year, :user_id)
        ");

        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'author' => $data['author'],
            'year' => $data['year'],
            'user_id' => $data['user_id'],
        ]);

        return $stmt->rowCount() > 0;
    }
}