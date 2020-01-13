<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }

    /**
     * Function that gets the user logged in after account has been created
     *
     * @param [type] $pdo
     * @param [type] $email
     * @return void
     */

    function logInWhenCreated($pdo, $emailIsValid)
    {
        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute(
            [
                ':email' => $emailIsValid
            ]
        );

        $users = $statement->fetch(PDO::FETCH_ASSOC);
        $storedEmail = $users['email'];

        if ($emailIsValid === $storedEmail) {
            $_SESSION['user'] = [
                'id' => $users['id'],
                'name' => $users['firstname'],
                'email' => $users['email'],
            ];

            redirect('/');
        }
    }

    /**
     * Get all comments from database
     *
     * @param [type] $pdo
     * @param [type] $postId
     * @return void
     */

    function getComments($pdo, $postId)
    {
        $statement = $pdo->prepare('SELECT users.firstname, users.lastname, comments.content, comments.id FROM users INNER JOIN comments ON comments.user_id = users.id WHERE comments.post_id = :postid ORDER BY comments.id');

        $statement->execute([
            ':postid' => $postId
        ]);

        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    /**
     * GETS USER BY ID
     *
     * @param [type] $pdo
     * @param [type] $userId
     * @return void
     */

    function getUserById($pdo, $userId)
    {
        $statement = $pdo->prepare('SELECT firstname, lastname, avatar, biography FROM users WHERE id = :userId');

        $statement->execute([
            ':userId' => $userId
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * FETCH ALL POSTS AND ADD THEM TO THE FEED IN INDEX.PHP
     *
     * @param [type] $pdo
     * @return void
     */

    function getFeed($pdo)
    {
        $getFeed = $pdo->query('SELECT posts.id, posts.user_id, posts.image, posts.caption, users.firstname, users.lastname FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY posts.id DESC');

        $feedPosts = $getFeed->fetchAll(PDO::FETCH_ASSOC);

        return $feedPosts;
    }

    /**
     * FETCH ALL POSTS BY USER AND SHOW IN ACCOUNT.PHP 
     *
     * @param [type] $pdo
     * @param [type] $userId
     * @return void
     */

    function getPosts($pdo, $userId)
    {
        $statement = $pdo->prepare('SELECT image, caption, posts.id, firstname, lastname FROM posts INNER JOIN users ON users.id = posts.user_id WHERE user_id = :id ORDER BY posts.id DESC');
        $statement->execute([
            ':id' => $_SESSION['user']['id']
        ]);

        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }
}
