<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php'; ?>
<article>

    <?php if (isset($_SESSION['user'])) : ?>
        <?php

        $posts = [];

        $statement = $pdo->prepare('SELECT users.id, users.firstname, users.lastname, users.avatar FROM users LEFT JOIN follows ON users.id = follows.user_id_followed WHERE follows.user_id_follows = :id');
        $statement->execute([
            ':id' => $_SESSION['user']['id']
        ]);

        foreach (($statement->fetchAll(PDO::FETCH_ASSOC)) as $followed) {
            foreach (getUserPosts($pdo, intval($followed['id'])) as $followsPost) {
                $posts[] = $followsPost;
            }
        }
        foreach (getUserPosts($pdo, $_SESSION['user']['id']) as $userPost) {
            $posts[] = $userPost;
        }
        $posts = sortsArrays($posts);
        ?>
        <div class="content-wrapper">
            <section class="content-feed">
                <?php foreach ($posts as $post) : ?>

                    <?php $statement = $pdo->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND post_id = :post_id");
                    $statement->execute([
                        ":user_id" => $_SESSION["user"]["id"],
                        ":post_id" => $post["id"]
                    ]);
                    $isLike = $statement->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <div class="posts-in-feed" data-id="<?php echo $post['id']; ?>">
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
                            <input type="hidden" name="postid" value="<?php echo $post['id'] ?>">
                            <button class="no-style-button" name="like" type="submit"><img class="icons" src="/assets/icons/<?php echo empty($isLike) ? "heart.svg" : "like.png"; ?>" alt="Image of a heart"></button>
                            <img class="icons comment" src="/assets/icons/comment.svg" alt="">
                        </form>


                        <p class="post-caption-in-feed"><?php echo $post['caption']; ?></p>

                        <ul class="comments">
                            <?php foreach (getComments($pdo, $post['id']) as $comment) : ?>
                                <?php if ($comment['user_id'] === $_SESSION['user']['id']) : ?>
                                    <li>

                                        <p class="comment"><?php echo $comment['firstname'] . ' ' . $comment['lastname'] . ': ' . $comment['content'];  ?></p>
                                        <form class="delete-form" method="post">
                                            <input class="hidden" type="hidden" name="commentid" value="<?php echo $comment['id'] ?>">
                                            <button class="comment-options" data-postId="<?php echo $post['id'] ?>" data-id="<?php echo $comment['id'] ?>" data-type="delete">Delete</button>
                                        </form>

                                        <button class="comment-options" data-postId="<?php echo $post['id'] ?>" data-id="<?php echo $comment['id'] ?>" data-type="edit">Edit</button>
                                    </li>
                                <?php else : ?>
                                    <li><?php echo $comment['firstname'] . ' ' . $comment['lastname'] . ': ' . $comment['content'];  ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                        <form action="app/posts/comment.php" method="post" class="comment-form">
                            <div class="comment-field">
                                <input type="hidden" name="postid" value="<?php echo $post['id'] ?>">
                                <input class="comment-input hidden" type="text" name="comment" placeholder="Leave your comment here" autocomplete="off">
                                <button class="send-comment hidden " type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($posts)) : ?>
                    <h1>Post from you and those you follow will show up here</h1>
                <?php endif; ?>
            </section>

        </div>

    <?php else : ?>
        <div class="start-info-container">
            <section class="start-info">
                <h1>Welcome to Picture This!</h1>
                <h5>This is just a simple btec version of Instagram made by Andreas Lindberg.</h5>
                <h5>Don't have an account already? <br> Click below to sign up and enjoy this crappy version of Instagram.</h5>
                <button class="sign-up-btn"><a href="signup.php">SIGN UP</a></button>
            </section>
        </div>

    <?php endif; ?>
</article>

<script src="assets/scripts/toggle.js"></script>
<script src="assets/scripts/like.js"></script>
<script src="assets/scripts/edit-comment.js"></script>
<script src="assets/scripts/comment.js"></script>


<?php require __DIR__ . '/views/footer.php'; ?>