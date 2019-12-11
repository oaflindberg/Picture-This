<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<div class="pwd-change-container">
    <section class="pwd-change">
        <h2>Change password</h2>
        <form class="form-section" action="/app/users/account.php" method="post">
            <label for="oldpassword">Current password</label>
            <input type="password" name="oldpassword" id="oldpassword">
            <label for="password">New password</label>
            <input type="password" name="password" id="password">
            <label for="passwordrepeat">Confirm new password</label>
            <input type="password" name="passwordconfirm" id="passwordconfirm">

            <div class="btns-container">
                <button type="submit">Reset</button>
                <button class="logout"><a href="/app/users/logout.php">Log out</a></button>
            </div>
        </form>
        <div class="email-change-container">
            <section class="email-change">
                <h2>Change email</h2>
                <form class="form-section" action="/app/users/account.php" method="post">
                    <label for="oldemail">Current email</label>
                    <input type="email" name="oldemail" id="oldemail">
                    <label for="email">New email</label>
                    <input type="email" name="newemail" id="newemail">
                    <div class="btns-container">
                        <button type="submit">Reset</button>
                    </div>
                </form>
            </section>
        </div>
        <div class="bio-change-container">
            <section class="bio-change">
                <h2>Change biography</h2>
                <form class="form-section" action="/app/users/account.php" method="post">
                    <label for="biography">Biography</label>
                    <input type="text" name="biography" id="biography">
                    <div class="btns-container">
                        <button type="submit">Update</button>
                    </div>
                </form>
            </section>
        </div>
    </section>




    <?php require __DIR__ . '/views/footer.php';
