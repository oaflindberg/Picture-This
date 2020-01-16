const searchForm = document.querySelector(".search-form");
console.log(searchForm);

searchForm.addEventListener("submit", function() {
    event.preventDefault();

    const searchInput = searchForm.querySelector("input");

    window.location.href + "?search=" + searchInput.value;

    const userList = document.querySelector(".userList");

    userList.innerHTML = "";

    var formData = new FormData(searchForm);

    if (searchInput.value === "") {
        const listItem = `<h1>You have to search for something</h1>`;
        userList.innerHTML += listItem;
    } else {
        fetch("app/users/search.php?search=" + searchInput.value, {
            method: "POST",
            body: formData
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(users) {
                users.forEach(function(user) {
                    if (user["error"] === 404) {
                        const listItem = `<h1>We couldn't find any users</h1>`;
                        userList.innerHTML += listItem;
                    } else {
                        const listItem = `<li class="searchedProfiles"><a href="/profile.php?username=${user["username"]}">
                        <img class="profileImageSearch" src="${user["avatar_image"]}"><p>${user["username"]}</p>
                        </a></li>`;
                        userList.innerHTML += listItem;
                    }
                });
            });
    }
});
