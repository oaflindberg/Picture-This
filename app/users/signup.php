<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
    $firstname = trim(filter_var($_POST['firstname'], FILTER_SANITIZE_STRING));
    $lastname = trim(filter_var($_POST['lastname'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $pdo->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)');
    if (!$query) {
        die(var_dump($pdo->errorInfo()));
    }
    $query->execute(
            [
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $email,
                ':password' => $password
            ]
        );

        redirect('/');
}