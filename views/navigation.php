<nav>

    <ul>
       
        <?php
        if (isset($_SESSION['user'])) : ?>
           <li>
            <a href="/index.php">Home</a>
        </li>
            <li>
                <a href="#">Search</a>
            </li>

            <a class="title" href="#"><?php echo $config['title']; ?></a>
            <li>
                <a href="/newpost.php">New Post</a>
            </li>
            <li>
                <a href="/account.php">Account</a>
            </li>
        <?php else : ?>

            <li>
            <a href="/index.php">Home</a>
        </li>
        <a class="title" href="#"><?php echo $config['title']; ?></a>

            <li>
                <a href="/login.php">Login</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>