<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['file'], $_POST['caption'])) {

    if ($_FILES['file']['type'] !== 'image/jpeg' && $_FILES['file']['type'] !== 'image/png') {
        $_SESSION['fileType'] = 'File type not accepted. Please choose a jpg or png file.';
        redirect('/newpost.php');
    }

    if ($_FILES['file']['size'] > 4000000) {
        $_SESSION['errors'] = 'The file is too big. Please choose a file that is smaller than 4MB.';
        redirect('/newpost.php');
    }
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
        ':caption' => $caption,
    ]);


    $statement = $pdo->prepare('SELECT image, posts.id FROM posts WHERE user_id = :id AND image = :image');
    $statement->execute([
        ':id' => $user['id'],
        ':image' => $filename
    ]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);

    $tags = checkHashtags($caption);
    foreach ($tags as $tag) {
        $newPost = $pdo->prepare('INSERT INTO tags (post_id, tag, user_id) VALUES(:id, :tag, :userid)');
        $newPost->execute([
            ':id' => $post['id'],
            ':tag' => $tag,
            ':userid' => $_SESSION['user']['id']
        ]);
    }
} else {
    redirect('/newpost.php');
}

redirect('/');
