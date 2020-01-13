<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['comment'])) {
    $statement = $pdo->prepare('INSERT INTO comments(user_id, post_id, content) VALUES(:userid, :postid, :content)');

    $statement->execute([
        ':userid' => $_SESSION['user']['id'],
        ':postid' => $_POST['postid'],
        ':content' => filter_var($_POST['comment'], FILTER_SANITIZE_STRING)
    ]);

    echo json_encode([getUserById($pdo, $_SESSION['user']['id']), $_POST['comment']]);
}
