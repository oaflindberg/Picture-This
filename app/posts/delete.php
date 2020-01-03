<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST)) {

    $deleteQuery = $pdo->prepare('DELETE from posts WHERE id = :id');

    $deleteQuery->execute([
        ':id' => $_GET['id']
    ]);

    redirect('/account.php');
}

redirect('/');
