<?php

$searchParam = isset($_GET['search']) ? trim($_GET['search']) : '';

$bookRepository = BookRepository::getInstance();
$books = $bookRepository->findAll($searchParam);

view('index', ['books' => $books]);
