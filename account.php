<?php

declare(strict_types=1); ?>

<?php require __DIR__ . '/views/header.php'; ?>
<?php require __DIR__ . '/app/posts/show.php'; ?>
<?php require __DIR__ . '/app/users/showavatar.php'; ?>

<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<div class="account-container">

    <section class="posts-wrapper">

        <section class="account">
            <div class="posts-header">

                <h1 class="posts-h1">Your posts</h1>
            </div>
            <?php if (isset($avatar['avatar'])) : ?>
                <img class="avatar-img" src="/uploads/avatar/<?php echo $avatar['avatar']; ?>" alt="avatar">
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

            <?php foreach ($posts as $post) : ?>
                <div class="posts" data-id="<?php echo $post['id']; ?>">
                    <a href="editpost.php?id=<?php echo $post['id']; ?>">
                        <img class="posts-in-account" src="/uploads/posts/<?php echo $post['image']; ?>" alt="<?php echo $post['caption']; ?>">
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

    <?php require __DIR__ . '/views/footer.php';
