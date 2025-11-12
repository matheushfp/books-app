<?php
require 'functions.php';

try {
    loadEnv(__DIR__ . '/.env');
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

require 'router.php';
