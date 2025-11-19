<?php

$conn = Database::getInstance()->getConnection();

$searchParam = isset($_GET['search']) ? trim($_GET['search']) : '';

$stmt = $conn->prepare("
    SELECT b.*, b.user_id AS userId, round(avg(r.rating)) AS avgRating, count(r.rating) AS reviewsCount
    FROM books b
    LEFT JOIN reviews r ON b.id = r.book_id
    WHERE b.title LIKE :searchParam
    GROUP BY b.id
    ORDER BY b.title ASC
");
$stmt->bindValue(':searchParam', "%$searchParam%");
$stmt->execute();

$books = $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);

view('index', ['books' => $books]);
