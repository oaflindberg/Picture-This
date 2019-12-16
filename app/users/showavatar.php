<?php

declare(strict_types=1);

$getAvatar = $pdo->prepare('SELECT avatar FROM users WHERE id = :id');
$getAvatar->execute([
    ':id' => $_SESSION['user']['id']
]);

$avatar = $getAvatar->fetch(PDO::FETCH_ASSOC);
