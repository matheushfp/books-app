<?php

$data = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = Validator::validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ], $data);

    if ($validation->fails()) {
        $_SESSION['errors'] = $validation->errors;
        view('login', ['data' => $data]);
        exit;
    }

    $userRepository = UserRepository::getInstance();
    $user = $userRepository->findByEmail($data['email']);

    if ($user) {

        if (!password_verify($data['password'], $user->passwordHash)) {
            $_SESSION['errors'][] = 'Invalid Credentials';
            view('login', ['data' => $data]);
            exit;
        }

        $_SESSION['auth'] = $user;
        header('Location: /');
        exit;
    }

    $_SESSION['errors'][] = 'Invalid Credentials';
    view('login', ['data' => $data]);
    exit;
}

view('login', ['data' => $data ?? []]);

unset($_SESSION['errors']);
