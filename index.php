<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <?php if (isset($_SESSION['user'])) : ?>
        <h1>Hello <?php echo $_SESSION['user']['name']; ?></h1>

        <?php else : ?>
            <div class="start-info-container">
                <section class="start-info">
                    <h1>Welcome to Picture This!</h1>
                    <h5>This is just a simple btec version of Instagram made by Andreas Lindberg.</h5>
                    <h5>Don't have an account already? Click below to sign up and enjoy this crappy version of Instagram.</h5>
                    <button> <a class="sign-up-btn" href="signup.php">SIGN UP</a></button>
                </section>
            </div>

    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>