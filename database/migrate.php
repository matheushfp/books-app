<?php

require_once 'functions.php';
require_once 'Database.php';
require_once 'Migration.php';

try {
    loadEnv(dirname(__DIR__) . '/.env');
} catch (Exception $e) {
    http_response_code(500);
    error_log($e->getMessage());
    exit;
}

$connection = Database::getInstance()->getConnection();
$migration = new Migration($connection);

if ($argc > 1 && $argv[1] === 'rollback') {
    $migration->rollback();
} else {
    $migration->migrate();
}
