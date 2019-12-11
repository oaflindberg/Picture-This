<?php

declare(strict_types=1);

require __DIR__ . '/../../views/header.php';

if (isset($_POST['oldpassword'], $_POST['password'], $_POST['passwordconfirm'])) {
    $oldPwd = $_POST['oldpassword'];
    $newPwd = $_POST['password'];
    $newPwdConfirm = $_POST['passwordconfirm'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedPwd = $user['password'];

    if (password_verify($oldPwd, $storedPwd) && $newPwd === $newPwdConfirm && $newPwd !== $oldPwd) {
        $changeQuery = $pdo->prepare('UPDATE users SET password = :newpassword WHERE id = :id');
        $changeQuery->execute([
            ':newpassword' => password_hash($newPwd, PASSWORD_DEFAULT),
            ':id' => $_SESSION['user']['id']
        ]);

        redirect('/app/users/logout.php');
    } else {
        die(var_dump($pdo->errorInfo()));
    }
}

if (isset($_POST['oldemail'], $_POST['newemail'])) {
    $oldEmail = $_POST['oldemail'];
    $newEmail = $_POST['newemail'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedEmail = $user['email'];

    if ($oldEmail === $storedEmail && $newEmail !== $storedEmail) {
        $changeQuery = $pdo->prepare('UPDATE users SET email = :newemail WHERE id = :id');
        $changeQuery->execute([
            ':newemail' => $newEmail,
            ':id' => $_SESSION['user']['id']
        ]);

        redirect('/app/users/logout.php');
    } else {
        die(var_dump($pdo->errorInfo()));
    }
}

if (isset($_POST['biography'])) {
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedBiography = $user['biography'];

    $changeQuery = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');
    $changeQuery->execute([
        ':biography' => $biography,
        ':id' => $_SESSION['user']['id']
    ]);

    redirect('/account.php');
} else {
    die(var_dump($pdo->errorInfo()));
}
