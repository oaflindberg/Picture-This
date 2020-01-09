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
}

$statement = $pdo->query('SELECT users.firstname, users.lastname, comments.content, comments.id FROM users INNER JOIN comments ON comments.user_id = users.id ORDER BY comments.id');

$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($comments);

// die(var_dump($comments));
