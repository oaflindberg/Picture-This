<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <?php if (isset($_SESSION['user'])) : ?>

        <div class="start-info-container">
            <section class="sign-up">
                <form class="form-section" action="app/posts/store.php" method="post" enctype="multipart/form-data">
                    <label for="file">Choose file to upload</label>
                    <input type="file" name="file" id="file" required>
                    <label for="caption">Caption</label>
                    <input type="text" name="caption" id="caption">
                    <button type="submit">Upload</button>
                </form>
            </section>
        </div>

    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>