<?php

if (!auth()) {
    header('Location: /');
    exit;
}

$conn = Database::getInstance()->getConnection();

$stmt = $conn->prepare("
    SELECT  
        id,
        title,
        description,
        author,
        year,
        user_id AS userId
    FROM books
    WHERE user_id = :userId 
    ORDER BY title");
$stmt->setFetchMode(PDO::FETCH_CLASS, Book::class);
$stmt->execute(['userId' => auth()->id]);

$books = $stmt->fetchAll();

view('my-books', ['data' => $data ?? [], 'books' => $books]);
