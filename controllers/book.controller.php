<?php
require 'data.php';

$id = $_REQUEST['id'];

$filtered = array_filter($books, fn($book) => $book['id'] == $id);
$book = array_pop($filtered);

view('book', ['book' => $book]);
