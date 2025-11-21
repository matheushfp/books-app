<?php

require '../models/Book.php';
require '../models/User.php';
require '../models/Review.php';

require '../repositories/Repository.php';
require '../repositories/BookRepository.php';
require '../repositories/ReviewRepository.php';
require '../repositories/UserRepository.php';

session_start();

require '../functions.php';
require '../utils/Validator.php';

try {
    loadEnv(dirname(__DIR__) . '/.env');
} catch (Exception $e) {
    http_response_code(500);
    error_log($e->getMessage());
    exit;
}

require '../database/Database.php';
require '../router.php';
