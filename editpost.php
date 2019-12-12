<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>

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

        <input class="account-input" type="text" name="editcaption" id="editcaption" value="<?php echo $post['caption']; ?>">
    </section>
</div>