<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php'; ?>
<?php require __DIR__ . '/app/posts/show.php'; ?>
<?php require __DIR__ . '/app/users/showavatar.php'; ?>



<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<div class="account-container">

    <h1 class="account-settings-header">Account settings</h1>
    <section class="bio-change">
        <h2>Change biography</h2>
        <form class="form-section" action="/app/users/account.php" method="post">
            <label for="biography">Biography</label>
            <textarea class="textarea biography-input account-input" name="biography" id="biography" cols="30" rows="5"><?php echo $biography["biography"]; ?></textarea>
            <div class="btns-container">
                <button class="account-btn" type="submit">Update</button>
            </div>
        </form>
    </section>
    <section class="avatar-change">
        <h2>Change profile picture</h2>
        <form class="form-section" action="/app/users/account.php" method="post" enctype="multipart/form-data">
            <label for="profilepicture">Profile picture</label>
            <input class="account-input avatar-input" type="file" accept="image/jpg, image/png" name="profilepicture" id="profilepicture">
            <div class="btns-container">
                <button class="account-btn" type="submit">Upload</button>
            </div>
        </form>
    </section>
    <section class="email-change">
        <h2>Change email</h2>
        <form class="form-section" action="/app/users/account.php" method="post">
            <label for="oldemail">Current email</label>
            <input class="account-input" type="email" name="oldemail" id="oldemail">">
            <label for="email">New email</label>
            <input class="account-input" type="email" name="newemail" id="newemail">
            <div class="btns-container">
                <button class="account-btn" type="submit">Change</button>
            </div>
        </form>
    </section>

    <section class="pwd-change">
        <h2>Change password</h2>
        <form class="form-section" action="/app/users/account.php" method="post">
            <label for="oldpassword">Current password</label>
            <input class="account-input" type="password" name="oldpassword" id="oldpassword">
            <label for="password">New password</label>
            <input class="account-input" type="password" name="password" id="password">
            <label for="passwordrepeat">Confirm new password</label>
            <input class="account-input" type="password" name="passwordconfirm" id="passwordconfirm">

            <div class="btns-container">
                <button class="account-btn" type="submit">Change</button>
                <button class="account-btn logout"><a href="/app/users/logout.php">Sign out</a></button>
            </div>
        </form>
    </section>
    <section class="delete-account">
        <form class="form-section" action="/app/users/delete.php" method="post">
            <h2>Delete account?</h2>
            <button class="account-btn delete-btn" type="submit">Yes</button>
        </form>
    </section>
</div>
</div>

<script src="/assets/scripts/confirm.js"></script>