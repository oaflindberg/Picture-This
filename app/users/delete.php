<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST)) {

    // DELETES USER AVATAR

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
    $userAvatar = $userInfo['avatar'];
    if (!empty($userAvatar)) {
        $fullPath = __DIR__ . "/../../uploads/avatar/$userAvatar";
        unlink($fullPath);
    }

    // DELETES THE USER

    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // DELETES THE POSTS 

    $statement = $pdo->prepare('SELECT * FROM posts where user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($posts)) {
        foreach ($posts as $post) {
            $image = $post['image'];
            $fullPath = __DIR__ . "/../../uploads/posts/$image";
            unlink($fullPath);
        }
    }

    $statement = $pdo->prepare('DELETE FROM posts WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // DELETES THE REACTIONS MADE BY USER

    $statement = $pdo->prepare('DELETE FROM reactions WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // DELETES THE COMMENTS MADE BY USER

    $statement = $pdo->prepare('DELETE FROM comments WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // DELETES FOLLOWS

    $statement = $pdo->prepare('DELETE FROM follows WHERE user_id_follows = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    session_destroy();
    redirect('/');
}
