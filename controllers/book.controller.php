<?php

$id = $_REQUEST['id'];

$bookRepository = BookRepository::getInstance();
$reviewRepository = ReviewRepository::getInstance();

$book = $bookRepository->findById($id);
$reviews = $reviewRepository->findByBook($book->id);

view('book', ['book' => $book, 'reviews' => $reviews]);
