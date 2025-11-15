<?php

require 'models/Book.php';
require 'models/User.php';

session_start();

require 'functions.php';
require 'utils/Validator.php';

try {
    loadEnv(__DIR__ . '/.env');
} catch (Exception $e) {
    http_response_code(500);
    error_log($e->getMessage());
    exit;
}

require 'database/Database.php';
require 'router.php';
