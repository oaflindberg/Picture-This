<?php

declare(strict_types=1); ?>

<?php require __DIR__ . '/views/header.php'; ?>

<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php $user = getUserById($pdo, $_SESSION['user']['id']) ?>

<div class="account-container">

    <section class="posts-wrapper">

        <section class="account">
            <div class="posts-header">

                <h1 class="posts-h1">Your posts</h1>
            </div>
            <?php if (isset($user['avatar'])) : ?>
                <img class="avatar-img" src="/uploads/avatar/<?php echo $user['avatar']; ?>" alt="avatar">
            <?php else : ?>
                <img class="avatar-img" src="/uploads/avatar/default.png" alt="avatar">
            <?php endif; ?>
            <div class="account-settings">
                <a href="settings.php">
                    <h1 class="posts-h1">Settings</h1>
                </a>
            </div>
        </section>

        <div class="posts-container">

            <?php foreach (getPosts($pdo, $_SESSION['user']['id']) as $post) : ?>
                <div class="posts" data-id="<?php echo $post['id']; ?>">
                    <a href="editpost.php?id=<?php echo $post['id']; ?>">
                        <?php $image = $post['image']; ?>
                        <?php if (file_exists(__DIR__ . "/uploads/posts/$image")) : ?>
                            <img class="posts-in-account" src="/uploads/posts/<?php echo $post['image']; ?>" alt="<?php echo $post['caption']; ?>">
                        <?php else : ?>
                            <img class="post-in-feed" src="/assets/images/image-not-available.jpg" alt="not available">
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

    <?php require __DIR__ . '/views/footer.php';
