<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['editcaption'])) {

    $editcaption = trim(filter_var($_POST['editcaption'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('UPDATE posts SET caption = :editcaption WHERE id = :id');
    $statement->execute([
        ':editcaption' => $editcaption,
        ':id' => $_GET['id']
    ]);

    $statement = $pdo->prepare('SELECT posts.id FROM posts WHERE user_id = :id AND caption = :caption');
    $statement->execute([
        ':id' => $_GET['id'],
        ':caption' => $editcaption
    ]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $pdo->prepare('DELETE FROM tags WHERE post_id = :id AND user_id = :userid');
    $statement->execute([
        ':id' => $_GET['id'],
        ':userid' => $_SESSION['user']['id']
    ]);

    $tags = checkHashtags($editcaption);
    // adds a seperate entry for every tag in a post caption so you can search for any tag
    foreach ($tags as $tag) {
        $newPost = $pdo->prepare('INSERT INTO tags (post_id, tag) VALUES(:id, :tag)');
        $newPost->execute([
            ':id' => $post['id'],
            ':tag' => $tag
        ]);
    }

    redirect('/account.php');
}

redirect('/');
