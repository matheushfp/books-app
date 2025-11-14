<?php

require 'utils/Validator.php';

$data = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = Validator::validate([
        'name' => ['required'],
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8', 'strong', 'confirmed'],
    ], $data);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors;
        view('sign-up', ['data' => $data]);
        exit;
    }

    $_SESSION['success'] = 'Account created successfully! Redirecting to Login...';
    header('Refresh:3; url=/login'); // Redirect user to /login after 3 seconds
}

view('sign-up', ['data' => $data] ?? []);

unset($_SESSION['errors']);
unset($_SESSION['success']);
