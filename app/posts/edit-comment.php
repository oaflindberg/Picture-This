<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}


header('Content-Type: application/json');
if (isset($_POST['postid'], $_POST['comment-edit'], $_POST['id'])) {
    $commentid = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $postid = filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT);
    $comment = trim(filter_var($_POST['comment-edit'], FILTER_SANITIZE_STRING));


    if (!filter_var($commentid, FILTER_VALIDATE_INT)) {
        echo json_encode('false');
    } else {

        $statement = $pdo->prepare('UPDATE comments SET content = :comment WHERE id = :id AND user_id = :userid');
        $statement->execute([
            ':comment' => $comment,
            ':id' => $commentid,
            ':userid' => $_SESSION['user']['id']
        ]);


        echo json_encode(['true', getUserById($pdo, $_SESSION['user']['id']), $comment, $commentid, $postid]);
    }
}
