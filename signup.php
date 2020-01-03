<?php

declare(strict_types=1);

?>

<img class="background-image" src="assets/images/abstract-3.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php'; ?>

<div class="sign-up-container">
    <article class="sign-up">
        <h1>Sign up</h1>

        <form action="app/users/signup.php" method="post">
            <div class="form-section">
                <label for="firstname">Firstname</label>
                <input class="input" type="text" id="firstname" name="firstname" placeholder="John" required>
            </div>

            <div class="form-section">
                <label for="lastname">Lastname</label>
                <input class="input" type="text" id="lastname" name="lastname" placeholder="Doe" required>
            </div>
            <div class="form-section">
                <label for="email">Email</label>
                <input class="input" type="email" id="email" name="email" placeholder="example@email.com" required>
                <?php if (isset($_SESSION['emailExists'])) : ?>
                    <p><?php echo $_SESSION['emailExists']; ?></p>
                    <?php unset($_SESSION['emailExists']); ?>
                <?php endif; ?>
            </div>

            <div class="form-section">
                <label for="password">Password</label>
                <input class="input" type="password" id="password" name="password" placeholder="*********" required>
            </div>

            <button type="submit">Sign up</button>
        </form>
    </article>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>