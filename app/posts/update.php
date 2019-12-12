<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['editcaption'])) {
    $editcaption = trim(filter_var($_POST['editcaption'], FILTER_SANITIZE_STRING));

    $changeQuery = $pdo->prepare('UPDATE posts SET caption = :caption WHERE id = :id');
    if (!$changeQuery) {
        die(var_dump($pdo->errorInfo()));
    }
    $changeQuery->execute([
        ':caption' => $editcaption,
        ':id' => $_GET['id']
    ]);
    redirect('/account.php');
}

redirect('/');
