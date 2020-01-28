<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');


if (isset($_POST['postid'])) {
    $like = 'like';
    $statement = $pdo->prepare('SELECT * FROM reactions WHERE reactions.user_id = :userid AND post_id = :postid');

    $statement->execute([
        ':userid' => $_SESSION['user']['id'],
        ':postid' => $_POST['postid']
    ]);



    $isLiked = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$isLiked) {

        $statement = $pdo->prepare('INSERT INTO reactions (user_id, post_id, reaction_type) VALUES(:userid, :postid, :types);');
        $statement->execute([
            ':userid' => $_SESSION['user']['id'],
            ':postid' => $_POST['postid'],
            ':types' => $like,
        ]);

        $liked = ['src' => 'like.png'];

        echo json_encode($liked);
    } else {
        $statement = $pdo->prepare('DELETE FROM reactions WHERE reactions.user_id = :userid AND post_id = :postid');

        $statement->execute([
            'userid' => $_SESSION['user']['id'],
            ':postid' => $_POST['postid']
        ]);

        $notLiked = ['src' => 'heart.svg'];

        echo json_encode($notLiked);
    }
}
