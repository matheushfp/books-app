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
        exit;
    }

    $conn = Database::getInstance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password_hash)");
    $stmt->execute([
        'name' => $data['name'],
        'email' => $data['email'],
        'password_hash' => password_hash($data['password'], PASSWORD_ARGON2ID)
    ]);

    if ($stmt->rowCount() <= 0) {
        $_SESSION['errors'] = "Something went wrong, please try again later.";
        header('location: sign-up');
        exit;
    }

    $_SESSION['success'] = 'Account created successfully! Redirecting to Login...';
    header('Refresh:2; url=/login'); // Redirect user to /login after 2 seconds
}

view('sign-up', ['data' => $data ?? []]);

unset($_SESSION['errors']);
unset($_SESSION['success']);
