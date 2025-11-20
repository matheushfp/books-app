<?php

if (!auth()) {
    header('Location: /');
    exit;
}

$bookRepository = BookRepository::getInstance();
$books = $bookRepository->findByUser(auth()->id);

view('my-books', ['data' => $data ?? [], 'books' => $books]);
