<?php
// Always start by loading the default application setup.
require __DIR__ . '/../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $config['title']; ?></title>

    <link rel="stylesheet" href="/assets/styles/main.css">
    <link rel="stylesheet" href="/assets/styles/navigation.css">
    <link rel="stylesheet" href="/assets/styles/login.css">
    <link rel="stylesheet" href="/assets/styles/editposts.css">
    <link rel="stylesheet" href="/assets/styles/newpost.css">
    <link rel="stylesheet" href="/assets/styles/feed.css">
    <link rel="stylesheet" href="/assets/styles/start.css">
    <link rel="stylesheet" href="/assets/styles/account.css">
    <link rel="stylesheet" href="/assets/styles/comment.css">
    <link rel="stylesheet" href="/assets/styles/search.css">

    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Lato&display=swap" rel="stylesheet">
</head>

<body>
    <?php require __DIR__ . '/navigation.php'; ?>

    <div>