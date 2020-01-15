<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST)) {

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
    $userAvatar = $userInfo['avatar'];
    $fullPath = __DIR__ . "/../../uploads/avatar/$userAvatar";
    unlink($fullPath);

    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    $statement = $pdo->prepare('DELETE FROM reactions WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    $statement = $pdo->prepare('DELETE FROM posts WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    $statement = $pdo->prepare('DELETE FROM comments WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    $statement = $pdo->prepare('DELETE FROM follows WHERE user_id_follows = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    session_destroy();
    redirect('/');
}
