<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php';
if (!isset($_SESSION['user'], $_GET['id'])) {
    redirect('/');
}

$postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$statement = $pdo->prepare('SELECT posts.id as postid , posts.image, posts.user_id, posts.caption, users.id, users.firstname, users.lastname FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE postid = :postid');
$statement->execute([
    ':postid' => $postId
]);

$post = $statement->fetch(PDO::FETCH_ASSOC);


?>


<div class="content-wrapper">
    <section class="content-feed">

        <?php $statement = $pdo->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND post_id = :post_id");
        $statement->execute([
            ":user_id" => $_SESSION["user"]["id"],
            ":post_id" => $post['postid']

        ]);
        $isLike = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="posts-in-feed" data-id="<?php echo $post['postid']; ?>">
            <p class="poster-name-in-feed"><?php echo $post['firstname'] . ' ' . $post['lastname']; ?></p>

            <div class="post-in-feed-container">
                <?php $image = $post['image']; ?>
                <?php if (file_exists(__DIR__ . "/uploads/posts/$image")) : ?>
                    <img class="post-in-feed" src="/uploads/posts/<?php echo $post['image']; ?>" alt="<?php echo $post['caption']; ?>">
                <?php else : ?>
                    <img class="post-in-feed" src="/assets/images/image-not-available.jpg" alt="not available">
                <?php endif; ?>
            </div>

            <form action="/app/posts/reactions.php" method="post" class="like-form">
                <input type="hidden" name="postid" value="<?php echo $post['postid'] ?>">
                <button class="no-style-button" name="like" type="submit"><img class="icons" src="/assets/icons/<?php echo empty($isLike) ? "heart.svg" : "like.png"; ?>" alt="Image of a heart"></button>
                <img class="icons comment" src="/assets/icons/comment.svg" alt="">
            </form>


            <p class="post-caption-in-feed"><?php echo $post['caption']; ?></p>

            <ul class="comments">
                <?php foreach (getComments($pdo, $post['postid']) as $comment) : ?>
                    <?php if ($comment['user_id'] === $_SESSION['user']['id']) : ?>
                        <li>

                            <p class="comment"><?php echo $comment['firstname'] . ' ' . $comment['lastname'] . ': ' . $comment['content'];  ?></p>
                            <form class="delete-form" method="post">
                                <input class="hidden" type="hidden" name="commentid" value="<?php echo $comment['id'] ?>">
                                <button class="comment-options" data-postId="<?php echo $post['postid'] ?>" data-id="<?php echo $comment['id'] ?>" data-type="delete">Delete</button>
                            </form>

                            <button class="comment-options" data-postId="<?php echo $post['postid'] ?>" data-id="<?php echo $comment['id'] ?>" data-type="edit">Edit</button>
                        </li>
                    <?php else : ?>
                        <li><?php echo $comment['firstname'] . ' ' . $comment['lastname'] . ': ' . $comment['content'];  ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <form action="app/posts/comment.php" method="post" class="comment-form">
                <div class="comment-field">
                    <input type="hidden" name="postid" value="<?php echo $post['postid'] ?>">
                    <input class="comment-input hidden" type="text" name="comment" placeholder="Leave your comment here" autocomplete="off">
                    <button class="send-comment hidden " type="submit">Send</button>
                </div>
            </form>
        </div>


        <script src="assets/scripts/toggle.js"></script>
        <script src="assets/scripts/like.js"></script>
        <script src="assets/scripts/edit-comment.js"></script>
        <script src="assets/scripts/comment.js"></script>

        <?php require __DIR__ . '/views/footer.php'; ?>