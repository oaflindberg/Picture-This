<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we login users.

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->execute(
        [
            ':email' => $email
        ]
    );
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    $userEmail = $users['email'];
    $userPwd = $users['password'];

    if ($email !== $userEmail) {
        $_SESSION['wrongEmail'] = [
            'error' => 'The email entered does not exist in our database',
        ];
        redirect('/login.php');
    }

    if (password_verify($password, $userPwd)) {
        $_SESSION['user'] = [
            'id' => $users['id'],
            'name' => $users['firstname'],
            'email' => $users['email'],
            'avatar' => $users['avatar'],
        ];
        redirect('/');
    } else {
        $_SESSION['wrongPwd'] = [
            'error' => 'Wrong password! Please try again.'
        ];
        redirect('/login.php');
    }
}
