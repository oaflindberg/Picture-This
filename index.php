<?php require __DIR__.'/views/header.php'; ?>

<article>
    <?php if (isset($_SESSION['user'])) : ?>
        <h1>Hello <?php echo $_SESSION['user']['name']; ?></h1>
        <?php endif ; ?>
    <div class="login">
        <?php require __DIR__.'/login.php'; ?>
    </div>        
</article>

<?php require __DIR__.'/views/footer.php'; ?>
