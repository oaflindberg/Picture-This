<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST)) {

    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id AND user_id = :userid');
    $statement->execute([
        ':id' => $_GET['id'],
        ':userid' => $_SESSION['user']['id']
    ]);
    $postInfo = $statement->fetch(PDO::FETCH_ASSOC);
    $postInfoImage = $postInfo['image'];
    $fullPath = __DIR__ . "/../../uploads/posts/$postInfoImage";
    unlink($fullPath);

    $changeQuery = $pdo->prepare('DELETE from posts WHERE id = :id AND user_id = :userid');

    $changeQuery->execute([
        ':id' => $_GET['id'],
        ':userid' => $_SESSION['user']['id']
    ]);

    $statement = $pdo->prepare('DELETE FROM reactions WHERE post_id = :post_id AND user_id = :userid');
    $statement->execute([
        ':post_id' => $_GET['id'],
        ':userid' => $_SESSION['user']['id']
    ]);

    $statement = $pdo->prepare('DELETE FROM tags WHERE post_id = :id AND user_id = :userid');
    $statement->execute([
        ':id' => $_GET['id'],
        ':userid' => $_SESSION['user']['id']
    ]);

    redirect('/account.php');
}

redirect('/');
