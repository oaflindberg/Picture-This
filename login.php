<img class="background-image" src="assets/images/abstract-1.jpeg" alt="abstract image">

<?php
require __DIR__ . '/views/header.php';
?>

<div class="login-container">
    <article class="login">
        <h1>Login</h1>

        <form action="app/users/login.php" method="post">
            <div class="form-section">
                <label for="email">Email</label>
                <input class="login-input" type="email" id="email" name="email" placeholder="example@email.com" required>
                <?php if (isset($_SESSION['wrongEmail'])) : ?>
                    <p><?php echo $_SESSION['wrongEmail']['error']; ?></p>
                    <?php unset($_SESSION['wrongEmail']) ?>
                <?php endif; ?>
            </div>

            <div class="form-section">
                <label for="password">Password</label>
                <input class="login-input" type="password" id="password" name="password" placeholder="*********" required>
                <?php if (isset($_SESSION['wrongPwd'])) : ?>
                    <p><?php echo $_SESSION['wrongPwd']['error']; ?></p>
                    <?php unset($_SESSION['wrongPwd']) ?>
                <?php endif; ?>
            </div>

            <button type="submit">Sign in</button>
        </form>
    </article>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>