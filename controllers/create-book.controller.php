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

$imagesDir = 'images/';
$defaultCover = 'images/default_cover.jpg';

$file = $defaultCover;
if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
    $bookCover = $_FILES['cover']['name'];
    $extension = strtolower(pathinfo($bookCover, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        $_SESSION['errors'][] = "Invalid image format. Only JPG and PNG are allowed.";
        header('Location: /my-books');
        exit;
    }

    try {
        $newFileName = bin2hex(random_bytes(16));
    } catch (Exception $e) {
        error_log($e->getMessage());
        exit;
    }

    $file = $imagesDir . $newFileName . '.' . $extension;
    move_uploaded_file($_FILES['cover']['tmp_name'], $file);
}

$bookRepository = BookRepository::getInstance();
$isBookCreated = $bookRepository->create([
    'title' => $title,
    'description' => $description,
    'author' => $author,
    'year' => $year,
    'user_id' => $userId,
    'cover' => $file
]);

if (!$isBookCreated) {
    $_SESSION['errors'] = "Something went wrong, please try again later.";
    header('Location: /my-books');
    exit;
}

$_SESSION['success'] = "Your book has been created.";
header('Location: /my-books');

unset($_SESSION['success']);
unset($_SESSION['errors']);
