<?php
require 'functions.php';
require 'models/Book.php';

try {
    loadEnv(__DIR__ . '/.env');
} catch (Exception $e) {
    http_response_code(500);
    error_log($e->getMessage());
    exit;
}

require 'database/Database.php';
require 'router.php';
