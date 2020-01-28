<?php

require __DIR__ . '/../autoload.php';

if (isset($_POST['search'])) {

    $searchedUsername = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT id, firstname, lastname, email, avatar FROM users WHERE firstname LIKE :searchedUsername OR lastname LIKE :searchedUsername');
    $statement->execute([
        ':searchedUsername' => $searchedUsername . '%',
    ]);

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['avatar'] === '' || $users[$i]['avatar'] === null) {
            $users[$i]['avatar'] = 'default.png';
        }
    }

    // Could make proper error and results array that "always" is sent with the request
    if ($users === []) {
        $users = json_encode([
            [
                'error' => 404,
            ]
        ]);
        header('Content-Type: application/json');
        echo $users;
    } else {

        $users = json_encode($users);
        header('Content-Type: application/json');
        echo $users;
    }
}
