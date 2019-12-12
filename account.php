<?php

declare(strict_types=1); ?>
<img class="background-image" src="assets/images/abstract-2.jpeg" alt="picture of a blue orange">
<?php require __DIR__ . '/views/header.php'; ?>
<?php require __DIR__ . '/app/posts/show.php'; ?>

<?php if (!isset($_SESSION['user'])) {
    redirect('/');
} ?>

<div class="account-container">


    <section class="posts-wrapper">

        <h1 class="posts-header">Your posts</h1>
        <div class="posts-container">

            <?php foreach ($posts as $post) : ?>
                <a href="editpost.php?id=<?php echo $post['id']; ?>">
                    <div class="posts" data-id="<?php echo $post['id']; ?>">
                        <img src="/uploads/posts/<?php echo $post['image']; ?>" alt="" height="150px" width="auto">
                        <p><?php echo $post['caption']; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>

        </div>
    </section>



    <h1 class="account-settings-header">Account settings</h1>
    <section class="bio-change">
        <h2>Change biography</h2>
        <form class="form-section" action="/app/users/account.php" method="post">
            <label for="biography">Biography</label>
            <input class="biography-input account-input" type="text" name="biography" id="biography" value="<?php echo $biography["biography"]; ?>">
            <div class="btns-container">
                <button class="account-btn" type="submit">Update</button>
            </div>
        </form>
    </section>
    <section class="avatar-change">
        <h2>Change profile-picture</h2>
        <form class="form-section" action="/app/users/account.php" method="post" enctype="multipart/form-data">
            <label for="profilepicture">Profile picture</label>
            <input class="account-input avatar-input" type="file" name="profilepicture" id="profilepicture">
            <div class="btns-container">
                <button class="account-btn" type="submit">Upload</button>
            </div>
        </form>
    </section>
    <section class="email-change">
        <h2>Change email</h2>
        <form class="form-section" action="/app/users/account.php" method="post">
            <label for="oldemail">Current email</label>
            <input class="account-input" type="email" name="oldemail" id="oldemail">
            <label for="email">New email</label>
            <input class="account-input" type="email" name="newemail" id="newemail">
            <div class="btns-container">
                <button class="account-btn" type="submit">Reset</button>
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
                <button class="account-btn" type="submit">Reset</button>
                <button class="account-btn" class="logout"><a href="/app/users/logout.php">Sign out</a></button>
            </div>
        </form>
    </section>
</div>




<?php require __DIR__ . '/views/footer.php';
