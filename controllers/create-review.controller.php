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

$reviewRepository = ReviewRepository::getInstance();
$isReviewCreated = $reviewRepository->create([
    'review_text' => $data['review_text'],
    'rating' => $data['rating'],
    'user_id' => $userId,
    'book_id' => $bookId
]);

if (!$isReviewCreated) {
    $_SESSION['errors'] = "Something went wrong, please try again later.";
    header('Location: /book?id=' . $bookId);
    exit;
}

header('Location: /book?id=' . $bookId);

unset($_SESSION['errors']);
