<?php

$id = $_REQUEST['id'];

$conn = Database::getInstance()->getConnection();

$query= $conn->prepare("SELECT * FROM books where id = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);

$query->setFetchMode(PDO::FETCH_CLASS, Book::class);
$query->execute();

$book = $query->fetch();

view('book', ['book' => $book]);
