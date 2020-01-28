<img class="background-image" src="assets/images/abstract-2.jpeg" alt="abstract image">
<?php require __DIR__ . '/views/header.php'; ?>



<div class="content-wrapper">
    <div class="search-wrapper">
        <h5 class="search-title">Users Search</h5>
        <form class="search-form-user" action="" method="POST">
            <input type="text" name="search" placeholder="Search for a user...">
            <button class="searchButton" type="submit" name="button">Search</button>
        </form>


        <h5 class="search-title">Search for post with a "tag"(#)</h5>
        <form class="search-form-tag" action="" method="POST">
            <input type="text" name="search" placeholder="Search for a tag...">
            <button class="searchButton" type="submit" name="button">Search</button>
        </form>
        <div class="user-list">

        </div>
        <div class="post-list">

        </div>
    </div>
</div>

<script src="assets/scripts/search.js"></script>

<?php require __DIR__ . '/views/footer.php'; ?>