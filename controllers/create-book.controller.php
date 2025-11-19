<?php

$data = $_POST;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /my-books');
    exit;
}

if (!auth()) abort(403);

$userId = auth()->id;
$title = $data['title'];
$description = $data['description'];
$author = $data['author'];
$year = $data['year'];

$validation = Validator::validate([
    'title' => ['required', 'min:3'],
    'description' => ['required'],
    'author' => ['required'],
    'year' => ['required'],
], $data);

if ($validation->fails()) {
    $_SESSION['errors'] = $validation->errors;
    view('my-books', ['data' => $data]);
    unset($_SESSION['errors']);
    exit;
}

$conn = Database::getInstance()->getConnection();

$stmt = $conn->prepare("
    INSERT INTO books (title, description, author, year, user_id) 
    VALUES (:title, :description, :author, :year, :userId)
");
$stmt->execute([
    'title' => $title,
    'description' => $description,
    'author' => $author,
    'year' => $year,
    'userId' => $userId,
]);

if ($stmt->rowCount() <= 0) {
    $_SESSION['errors'] = "Something went wrong, please try again later.";
    header('Location: /my-books');
    exit;
}

$_SESSION['success'] = "Your book has been created.";
header('Location: /my-books');

unset($_SESSION['success']);
unset($_SESSION['errors']);
