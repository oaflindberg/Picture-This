<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_FILES['file'], $_POST['caption'])) {

    $image = $_POST['file'];
    $caption = trim(filter_var($_POST['caption'], FILTER_SANITIZE_STRING));

    // file_put_contents()


    // $newPost = $pdo->prepare('INSERT INTO posts (image, caption) VALUES(:image, :caption)'); 
    // $newPost->execute([
    //     ':image' => $image,
    //     ':caption' => $caption
    // ]);
}

redirect('/');
