<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <?php if (isset($_SESSION['user'])) : ?>

        <div class="start-info-container">
            <section class="sign-up">
                <?php if (isset($_SESSION['errors'])) : ?>
                    <p>
                        <?php
                        echo $_SESSION['errors'];
                        unset($_SESSION['errors']);
                        ?>
                    </p>
                <?php endif; ?>
                <form class="form-section" action="app/posts/store.php" method="post" enctype="multipart/form-data">
                    <label for="file">Choose file to upload</label>
                    <input type="file" name="file" id="file" accept="image/jpg, image/png" required>
                    <label for="caption">Caption</label>
                    <textarea class="textarea" name="caption" id="caption" cols="30" rows="5"></textarea>
                    <button type="submit">Upload</button>
                </form>
            </section>
        </div>

    <?php else : ?>
        <?php redirect('/'); ?>
    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>