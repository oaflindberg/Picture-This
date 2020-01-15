<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php'; ?>


<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<?php

$statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :id AND id = :postid');
$statement->execute([
    ':id' => $_SESSION['user']['id'],
    ':postid' => $_GET['id']
]);

$editPosts = $statement->fetch(PDO::FETCH_ASSOC);;
?>

<div class="edit-posts-container">
    <section class="edit-posts">
        <img class="edit-posts-image" src="/uploads/posts/<?php echo $editPosts['image']; ?>" alt="" height="150px" width="auto">
        <form class="edit-posts-form" action="/app/posts/update.php?id=<?php echo $_GET['id']; ?>" method="post">
            <textarea class="textarea edit-caption" name="editcaption" id="editcaption" cols="30" rows="5"><?php echo $editPosts['caption']; ?></textarea>
            <button class="update-post" type="submit">Update</button>
        </form>
    </section>
    <section class="delete-posts">
        <h1 class="delete-post-h1">Delete Post?</h1>
        <form action="/app/posts/delete.php?id=<?php echo $_GET['id']; ?>" method="post">
            <button type="submit">Delete</button>
        </form>
    </section>
</div>