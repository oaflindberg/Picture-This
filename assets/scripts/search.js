const searchFormUsers = document.querySelector(".search-form-user");

searchFormUsers.addEventListener("submit", function() {
    event.preventDefault();

    const searchInput = searchFormUsers.querySelector("input");

    const userList = document.querySelector(".user-list");

    document.querySelector(".post-list").innerHTML = "";

    userList.innerHTML = "";

    var formData = new FormData(searchFormUsers);

    if (searchInput.value === "") {
        const listItem = `<h1>You have to search for something</h1>`;
        userList.innerHTML += listItem;
    } else {
        fetch("app/users/search.php", {
            method: "POST",
            body: formData
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(users) {
                console.log(users);
                users.forEach(function(user) {
                    if (user["error"] === 404) {
                        const listItem = `<h1>We couldn't find any users</h1>`;
                        userList.innerHTML += listItem;
                    } else {
                        const listItem = `<li class="searchedProfiles"><a href="/account.php?id=${
                            user["id"]
                        }">
                        <img class="profileImageSearch" src="/uploads/avatar/${
                            user["avatar"]
                        } "><p>${user["firstname"] + " " + user["lastname"]}</p>
                        </a></li>`;
                        userList.innerHTML += listItem;
                    }
                });
            });
    }
});

const searchFormTags = document.querySelector(".search-form-tag");

searchFormTags.addEventListener("submit", function() {
    event.preventDefault();

    document.querySelector(".user-list").innerHTML = "";

    const searchInput = searchFormTags.querySelector("input");

    const postList = document.querySelector(".post-list");

    postList.innerHTML = "";

    var formData = new FormData(searchFormTags);

    if (searchInput.value === "") {
        const listItem = `<h1>You have to search for something</h1>`;
        postList.innerHTML += listItem;
    } else {
        fetch("app/posts/search.php", {
            method: "POST",
            body: formData
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(posts) {
                posts.forEach(function(post) {
                    if (post["error"] === 404) {
                        const listItem = `<h1>We couldn't find any post</h1>`;
                        postList.innerHTML += listItem;
                    } else {
                        const listItem = `<li class="posts-in-feed"><a href="/account.php?id=${
                            post["user_id"]
                        }">
                        <p>${post["firstname"] + " " + post["lastname"]}</p>
                        </a>
                        
                        <a class="post-in-feed-container" href="/post.php?id=${
                            post["postid"]
                        }">
                        <img class="post-in-feed" src="/uploads/posts/${
                            post["image"]
                        } ">
                        </a>
                        
                        
                        <p class="post-caption-in-feed white" >${
                            post["caption"]
                        }</p>
                        
                        </li>`;
                        postList.innerHTML += listItem;
                    }
                });
            });
    }
});
