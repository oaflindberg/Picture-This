<?php

?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <?php if (isset($_SESSION['user'])) : ?>

        <div class="new-post-container">
            <section class="new-post">
                <form class="form-section" action="app/posts/store.php" method="post" enctype="multipart/form-data">
                    <?php if (isset($_SESSION['fileType'])) : ?>
                        <?php echo $_SESSION['fileType']; ?>
                        <?php unset($_SESSION['fileType']); ?>
                    <?php endif; ?>
                    <label for="file">Choose file to upload</label>
                    <input type="file" name="file" id="file" accept="image/jpg, image/png" required>
                    <label for="caption">Caption</label>
                    <textarea class="textarea" name="caption" id="caption" cols="30" rows="5"></textarea>
                    <button class="upload-post" type="submit">Upload</button>
                </form>
            </section>
        </div>

    <?php else : ?>
        <?php redirect('/'); ?>
    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>