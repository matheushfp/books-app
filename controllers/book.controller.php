<?php

$id = $_REQUEST['id'];

$conn = Database::getInstance()->getConnection();

$stmt= $conn->prepare("
    SELECT b.*, b.user_id AS userId, round(avg(r.rating)) AS avgRating, count(r.rating) AS reviewsCount
    FROM books b
    LEFT JOIN reviews r on b.id = r.book_id
    WHERE b.id = :id
    GROUP BY b.id
");
$stmt->setFetchMode(PDO::FETCH_CLASS, Book::class);
$stmt->execute(['id' => $id]);

$book = $stmt->fetch();

$stmt = $conn->prepare("
    SELECT
        id,
        review_text AS reviewText,
        rating,
        book_id AS bookId,
        user_id AS userId
    FROM reviews 
    WHERE book_id = :bookId
");
$stmt->setFetchMode(PDO::FETCH_CLASS, Review::class);
$stmt->execute([':bookId' => $book->id]);

$reviews = $stmt->fetchAll();

view('book', ['book' => $book, 'reviews' => $reviews]);
