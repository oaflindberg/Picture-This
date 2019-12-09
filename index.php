<img class="background-image" src="assets/images/blue-orange.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <?php if (isset($_SESSION['user'])) : ?>
        <h1>Hello <?php echo $_SESSION['user']['name']; ?></h1>
    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>