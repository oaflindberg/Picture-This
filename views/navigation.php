<nav>

    <ul>
        <li>
            <a href="/index.php">Home</a>
        </li>
        <a class="title" href="#"><?php echo $config['title']; ?></a>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <li>
                <a class="logout" href="/app/users/logout.php">Logout</a>
            </li>
        <?php else : ?>

            <li>
                <a href="/login.php">Login</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>