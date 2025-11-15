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

    $conn = Database::getInstance()->getConnection();
    $stmt = $conn->prepare('SELECT id, name, email, password_hash AS passwordHash FROM users WHERE email = :email');
    $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
    $stmt->execute(['email' => $data['email']]);

    $user = $stmt->fetch();

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
