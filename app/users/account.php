<?php

declare(strict_types=1); ?>
<?php

require __DIR__ . '/../../views/header.php';
// require __DIR__ . '/../autoload.php';


if (isset($_POST['oldpassword'], $_POST['password'], $_POST['passwordconfirm'])) {
    $oldPwd = $_POST['oldpassword'];
    $newPwd = $_POST['password'];
    $newPwdConfirm = $_POST['passwordconfirm'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        'id' => $_SESSION['user']['id']
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedPwd = $user['password'];

    if (password_verify($oldPwd, $storedPwd) && $newPwd === $newPwdConfirm && $newPwd !== $oldPwd) {
        $changeQuery = $pdo->prepare('UPDATE users SET password = :newpassword WHERE id = :id');
        $changeQuery->execute([
            ':newpassword' => password_hash($newPwd, PASSWORD_DEFAULT),
            ':id' => $_SESSION['user']['id']
        ]);

        redirect('/app/users/logout.php');
    } else {
        die(var_dump($pdo->errorInfo()));
    }
}
