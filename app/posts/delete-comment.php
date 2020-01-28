<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}
header('Content-Type: application/json');
if (isset($_POST['commentid'])) {
    $commentid = filter_var($_POST['commentid'], FILTER_SANITIZE_NUMBER_INT);
    if ($commentid === '') {
        echo json_encode('false');
    } else {

        $statement = $pdo->prepare('DELETE FROM comments WHERE id = :id AND user_id = :userid');
        $statement->execute([
            ':id' => $commentid,
            ':userid' => $_SESSION['user']['id']
        ]);


        echo json_encode('true');
    }
}
