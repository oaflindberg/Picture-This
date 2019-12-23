<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['file'], $_POST['caption'])) {
    if ($_FILES['file']['size'] > 4000000) {
        $_SESSION['errors'] = 'The file is too big. Please choose a file that is smaller than 4MB.';
        redirect('/newpost.php');
    } else {
        $image = $_FILES['file'];
        $caption = trim(filter_var($_POST['caption'], FILTER_SANITIZE_STRING));

        $filename = 'Picture-This' . '-' . date('ymdsu') . '.png';

        $destination = __DIR__ . '/../../uploads/posts/' . $filename;

        move_uploaded_file($image['tmp_name'], $destination);

        $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute([
            'id' => $_SESSION['user']['id']
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);


        $newPost = $pdo->prepare('INSERT INTO posts (user_id, image, caption) VALUES(:id, :image, :caption)');
        $newPost->execute([
            ':id' => $user['id'],
            ':image' => $filename,
            ':caption' => $caption
        ]);
    }
} else {
    redirect('/newpost.php');
}

redirect('/');
