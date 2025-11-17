<?php

$data = $_POST;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !auth()) {
    header('Location: /');
    exit;
}

$userId = auth()->id;
$bookId = $data['book_id'] ?? null;

if (!$bookId) {
    header('Location: /');
    exit;
}

$validation = Validator::validate([
    'review_text' => ['required'],
    'rating' => ['required'],
], $data);

if ($validation->fails()) {
    $_SESSION['errors'] = $validation->errors;
    header('Location: /book?id=' . $bookId);
    exit;
}

$conn = Database::getInstance()->getConnection();

$stmt = $conn->prepare("
            INSERT INTO reviews (review_text, rating, user_id, book_id) 
            VALUES (:review_text, :rating, :user_id, :book_id)
");
$stmt->execute([
    'review_text' => $data['review_text'],
    'rating' => $data['rating'],
    'user_id' => $userId,
    'book_id' => $bookId
]);

if ($stmt->rowCount() <= 0) {
    $_SESSION['errors'] = "Something went wrong, please try again later.";
    header('Location: /book?id=' . $bookId);
    exit;
}

header('Location: /book?id=' . $bookId);

unset($_SESSION['errors']);
