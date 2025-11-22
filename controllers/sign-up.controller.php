<?php

$data = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = Validator::validate([
        'name' => ['required'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:8', 'strong', 'confirmed'],
    ], $data);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors;
        view('sign-up', ['data' => $data]);
        unset($_SESSION['errors']);
        exit;
    }

    $userRepository = UserRepository::getInstance();
    $isUserCreated = $userRepository->create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password_hash' => password_hash($data['password'], PASSWORD_ARGON2ID)
    ]);

    if (!$isUserCreated) {
        $_SESSION['errors'] = "Something went wrong, please try again later.";
        header('location: sign-up');
        unset($_SESSION['errors']);
        exit;
    }

    $_SESSION['success'] = 'Account created successfully! Redirecting to Login...';
    header('Refresh:2; url=/login'); // Redirect user to /login after 2 seconds
}

view('sign-up', ['data' => $data ?? []]);

unset($_SESSION['errors']);
unset($_SESSION['success']);
