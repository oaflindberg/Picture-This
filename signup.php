<?php 

declare(strict_types=1);

?>

<img class="background-image" src="assets/images/abstract-3.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>

<div class="sign-up-container">
    <article class="sign-up">
        <h1>Sign up</h1>

        <form action="app/users/signup.php" method="post">
            <div class="form-section">
                <label for="firstname">Firstname</label>
                <input class="input" type="text" name="firstname" placeholder="John" required>
            </div>

            <div class="form-section">
                <label for="lastname">Lastname</label>
                <input class="input" type="text" name="lastname" placeholder="Doe" required>
            </div>
            <div class="form-section">
                <label for="email">Email</label>
                <input class="input" type="email" name="email" placeholder="example@email.com" required>
            </div>

            <div class="form-section">
                <label for="password">Password</label>
                <input class="input" type="password" name="password" placeholder="*********" required>
            </div>
            
            <button type="submit">Sign up</button>
        </form>
    </article>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>