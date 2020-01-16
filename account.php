<?php

declare(strict_types=1); ?>

<?php require __DIR__ . '/views/header.php'; ?>

<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php if (isset($_GET['id'])) {
    $userId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if ($userId == '') {
        $userId = $_SESSION['user']['id'];
    }
} else {
    $userId = $_SESSION['user']['id'];
}
?>

<?php $user = getUserById($pdo, $userId) ?>

<div class="account-container">

    <section class="posts-wrapper">

        <section class="account">
            <div class="posts-header">

                <h1 class="posts-h1"><?php echo $user['firstname'] === $_SESSION['user']['name'] ? 'Your' : $user['firstname'] . 's' ?> posts</h1>
            </div>

            <?php if ($user['avatar'] !== '' && !empty($user['avatar'])) : ?>
                <img class="avatar-img" src="/uploads/avatar/<?php echo $user['avatar']; ?>" alt="avatar">
            <?php else : ?>
                <img class="avatar-img" src="/uploads/avatar/default.png" alt="avatar">
            <?php endif; ?>

            <div class="account-settings">
                <?php if ($user['id'] === $_SESSION['user']['id']) : ?>
                    <a href="settings.php">
                        <h1 class="posts-h1">Settings</h1>
                    </a>
                <?php endif; ?>
            </div>



        </section>
        <h2 class="account-name"><?php echo $user['firstname'] . ' ' .  $user['lastname'] ?></h2>

        <div class="posts-container">

            <?php foreach (getPosts($pdo, $user['id']) as $post) : ?>
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
