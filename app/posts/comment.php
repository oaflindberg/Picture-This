<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['comment'])) {
    $postid = filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);


    $statement = $pdo->prepare('INSERT INTO comments(user_id, post_id, content) VALUES(:userid, :postid, :content)');

    $statement->execute([
        ':userid' => $_SESSION['user']['id'],
        ':postid' => $postid,
        ':content' => $comment
    ]);

    foreach (getComments($pdo, $postid) as $postComment) {
        if ($postComment['content'] === $comment) {
            $userCommentId = $postComment['id'];
        }
    }

    echo json_encode([getUserById($pdo, $_SESSION['user']['id']), $comment, $userCommentId, $postid]);
}
