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
}
