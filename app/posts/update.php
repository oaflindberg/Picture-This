<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['editcaption'], $_GET)) {

    $editcaption = trim(filter_var($_POST['editcaption'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('UPDATE posts SET caption = :editcaption WHERE id = :id');

    $statement->execute([
        ':editcaption' => "$editcaption",
        ':id' => $_GET['id']
    ]);
    // die(var_dump($statement));
    redirect('/account.php');
}
// die(var_dump($pdo->errorInfo()));

redirect('/');
