const searchForm = document.querySelector(".search-form");
console.log(searchForm);

searchForm.addEventListener("submit", function() {
    event.preventDefault();

    const searchInput = searchForm.querySelector("input");

    const userList = document.querySelector(".user-list");

    userList.innerHTML = "";

    var formData = new FormData(searchForm);

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
