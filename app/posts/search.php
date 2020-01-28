<?php

require __DIR__ . '/../autoload.php';

if (isset($_POST['search'])) {

    $tag = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('SELECT * FROM (SELECT posts.id as postid, posts.image ,posts.caption, users.id as user_id, users.firstname, users.lastname FROM posts LEFT JOIN users ON users.id = posts.user_id) as post LEFT JOIN tags ON tags.post_id = post.postid WHERE tag LIKE :tag GROUP BY tags.post_id');
    $statement->execute([
        ':tag' => $tag . '%',
    ]);

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);



    // Could make proper "code" and results array that "always" is sent with the request
    if ($posts === []) {
        $posts = json_encode([
            [
                'error' => 404,
            ]
        ]);
        header('Content-Type: application/json');
        echo $posts;
    } else {

        $posts = json_encode($posts);
        header('Content-Type: application/json');
        echo $posts;
    }
}
