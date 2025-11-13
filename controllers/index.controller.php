<?php

$conn = Database::getInstance()->getConnection();

$searchParam = isset($_GET['search']) ? trim($_GET['search']) : '';

$stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE :searchParam ORDER BY title ASC");
$stmt->bindValue(':searchParam', "%$searchParam%");
$stmt->execute();

$books = $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);

view('index', ['books' => $books]);
