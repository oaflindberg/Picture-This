<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
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

$post = $statement->fetch(PDO::FETCH_ASSOC);
?>

<div class="test">
    <section class="edit-container">
        <img src="/uploads/posts/<?php echo $post['image']; ?>" alt="" height="150px" width="auto">
        <form action="/app/posts/update.php" method="post">
            <!-- <textarea class="textarea account-input" name="editcaption" id="editcaption" cols="30" rows="10"><?php echo $post['caption']; ?></textarea> -->
            <input type="text" name="editcaption" id="editcaption" value="<?php echo $post['caption']; ?>">
            <button type="submit">Update</button>
        </form>
        <h1>Delete Post?</h1>
        <form action="/app/posts/delete.php" method="post">
            <button type="submit">Delete</button>
        </form>
    </section>

    <?php die(var_dump($_SESSION['user']['id'])); ?>
    <?php die(var_dump($_GET['id'])); ?>



</div>