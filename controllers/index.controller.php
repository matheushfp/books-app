<?php

$conn = Database::getInstance()->getConnection();
$books = $conn->query("SELECT * FROM books")->fetchAll(PDO::FETCH_CLASS, Book::class);

view('index', ['books' => $books]);
