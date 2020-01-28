<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['errors'][] = 'Please log in and try again';
    redirect('/');
}


if (isset($_POST['userId'])) {

    $followedUser = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);

    $followedUser = getUserById($pdo, $followedUser);

    $check = checkIfFollowed($pdo, intval($followedUser['id']), intval($_SESSION['user']['id']));

    // die(var_dump($check));

    if ($check === false) {
        $_SESSION['errors'][] = 'Something went wrong...';
    }


    if (!isset($_SESSION['errors'])) {
        $statement = $pdo->prepare('DELETE FROM follows WHERE user_id_followed = :followed_user_id AND user_id_follows = :userId');
        $statement->execute([
            ':followed_user_id' => $followedUser['id'],
            ':userId' => $_SESSION['user']['id'],
        ]);
        redirect('../../account.php?id=' . $followedUser['id']);
    } else {
        redirect('../../account.php?id=' . $followedUser['id']);
    }


    // if (!isset($_SESSION['errors'])) {
    //     $followed = json_encode([
    //             'response' => true
    //     ]);
    // }else {
    //     $followed = json_encode([
    //             'response' => false
    //     ]);
    // }
    //
    // header('Content-Type: application/json');
    // echo $followed;


}
