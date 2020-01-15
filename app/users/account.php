<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


//  UPDATE PASSWORD

if (isset($_POST['oldpassword'], $_POST['password'], $_POST['passwordconfirm'])) {
    $oldPwd = $_POST['oldpassword'];
    $newPwd = $_POST['password'];
    $newPwdConfirm = $_POST['passwordconfirm'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
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
        $_SESSION['doesNotMatch'] = 'Passwords does not match.';
        redirect('/settings.php');
    }
}

//  UPDATE EMAIL

if (isset($_POST['oldemail'], $_POST['newemail'])) {
    $oldEmail = filter_var($_POST['oldemail'], FILTER_SANITIZE_EMAIL);
    $oldValidEmail = filter_var($_POST['oldemail'], FILTER_VALIDATE_EMAIL);
    $newEmail = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);
    $newValidEmail = filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL);

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedEmail = $user['email'];

    if ($oldValidEmail === $storedEmail && $newValidEmail !== $storedEmail) {
        $changeQuery = $pdo->prepare('UPDATE users SET email = :newemail WHERE id = :id');
        $changeQuery->execute([
            ':newemail' => $newValidEmail,
            ':id' => $_SESSION['user']['id']
        ]);

        redirect('/app/users/logout.php');
    } else {
        $_SESSION['emailNotValid'] = 'Something went wrong. Please try again.';
    }
}

//  UPDATE BIOGRAPHY

if (isset($_POST['biography'])) {
    $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedBiography = $user['biography'];

    $changeQuery = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');
    $changeQuery->execute([
        ':biography' => $biography,
        ':id' => $_SESSION['user']['id']
    ]);

    redirect('/account.php');
}

//  UPDATE AVATAR

if (isset($_FILES['profilepicture'])) {

    $avatar = $_FILES['profilepicture'];

    if (!empty($avatar)) {
        $filename = 'avatar' . '-' . date('ymdsu') . '.png';

        $destination = __DIR__ . '/../../uploads/avatar/' . $filename;

        move_uploaded_file($avatar['tmp_name'], $destination);

        $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute([
            ':id' => $_SESSION['user']['id']
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);


        $newAvatar = $pdo->prepare('UPDATE users SET avatar = :newavatar WHERE id = :id');
        $newAvatar->execute([
            ':id' => $_SESSION['user']['id'],
            ':newavatar' => $filename,
        ]);
        redirect('/account.php');
    } else {
        $_SESSION['noAvatar'] = 'Please select a file to update your avatar';
        redirect('/settings.php');
    }
}
