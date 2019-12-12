<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['editcaption'])) {
    $statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :id AND id = :postid');
    $statement->execute([
        ':id' => $_SESSION['user']['id'],
        ':postid' => $_GET['id']
    ]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);


    $caption = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));

    $changeQuery = $pdo->prepare('UPDATE posts SET caption = :caption WHERE id = :id');
    $changeQuery->execute([
        ':caption' => $caption,
        ':id' => $_SESSION['user']['id']
    ]);
    redirect('/account.php');
}

redirect('/');
