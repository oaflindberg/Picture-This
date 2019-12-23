<?php

declare(strict_types=1);

$statement = $pdo->prepare('SELECT * FROM posts INNER JOIN users ON users.id = posts.user_id WHERE user_id = :id');
$statement->execute([
    ':id' => $_SESSION['user']['id']
]);

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);


$getBio = $pdo->prepare('SELECT biography FROM users WHERE id = :id');
$getBio->execute([
    ':id' => $_SESSION['user']['id']
]);

$biography = $getBio->fetch(PDO::FETCH_ASSOC);
