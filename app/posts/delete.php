<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST)) {

    $changeQuery = $pdo->prepare('DELETE from posts WHERE id = :id');

    $changeQuery->execute([
        ':id' => $_GET['id']
    ]);

    redirect('/account.php');
}

redirect('/');
