<?php

function view($view, $data = []) {
    extract($data);

    $viewPath = $view;
    require "views/layouts/app.php";
}

function dd(...$dump) {
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
    die();
}

function abort($statusCode) {
    http_response_code($statusCode);
    view($statusCode);
    exit;
}

/**
 * @throws RuntimeException
 */
function loadEnv($path) {
    if (!file_exists($path)) {
        throw new RuntimeException(".env file not found in: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;

        // Split using "="
        [$name, $value] = array_map('trim', explode('=', $line, 2));

        // Remove quotes (single or double) from the value
        $value = trim($value, '"\'');

        // Set the environment variable for getenv() and $_ENV
        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}

function auth() {
    if (empty($_SESSION['auth'])) {
        return null;
    }

    return $_SESSION['auth'];
}