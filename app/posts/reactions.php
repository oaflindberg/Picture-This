<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$like = 'like';
$hej = '1';

if (isset($_POST)) {
    $statement = $pdo->prepare('INSERT INTO reactions (user_id, post_id, reaction_type) VALUES(:userid, :postid, :like)');

    $statement->execute([
        ':userid' => $_SESSION['user']['id'],
        ':postid' => $post['id'],
        ':like' => $like,
    ]);
    redirect('/');
}
