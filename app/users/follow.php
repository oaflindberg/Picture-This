<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
};

if (isset($_POST['userId'])) {

    $followedUser = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);

    $followedUser = getUserById($pdo, $followedUser);

    $check = checkIfFollowed($pdo, intval($followedUser['id']), intval($_SESSION['user']['id']));
    if ($check !== false) {
        $_SESSION['errors'][] = 'You already follows this user';
    }

    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('INSERT INTO follows (user_id_followed, user_id_follows) VALUES(:followed_user_id, :userId)');
        $statement->execute([
            ':followed_user_id' => $followedUser['id'],
            ':userId' => $_SESSION['user']['id'],
        ]);
        redirect('../../account.php?id=' . $followedUser['id']);
    } else {
        redirect('../../account.php?id=' . $followedUser['id']);
    }

    // if (!$check) {
    //     $followed = json_encode([
    //             'response' => false
    //     ]);
    // }else {
    //     $followed = json_encode([
    //             'response' => true
    //     ]);
    // }
    //
    // header('Content-Type: application/json');
    // echo $followed;


}
