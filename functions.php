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
