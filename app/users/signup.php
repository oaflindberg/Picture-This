<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
    $firstname = trim(filter_var($_POST['firstname'], FILTER_SANITIZE_STRING));
    $lastname = trim(filter_var($_POST['lastname'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->execute(
        [
            ':email' => $email
        ]
    );

    $users = $statement->fetch(PDO::FETCH_ASSOC);
    $storedEmail = $users['email'];

    if ($storedEmail === $emailIsValid) {
        $_SESSION['emailExists'] = 'This email already exists in our database';
        redirect('/signup.php');
    } else {
        $query = $pdo->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)');

        $query->execute(
            [
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $emailIsValid,
                ':password' => $password
            ]
        );
        logInWhenCreated($pdo, $emailIsValid);
    }
    redirect('/signup.php');
}
