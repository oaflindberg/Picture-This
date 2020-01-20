const commentOptions = document.querySelectorAll(".comment-options");

commentOptions.forEach(commentButton => {
    commentButton.addEventListener("click", e => {
        const comment = e.path[1].children[0].textContent.split(":")[1];
        const postId = e.target.dataset.postid;
        if (e.target.dataset.type === "edit") {
            console.log(comment);
            e.path[1].innerHTML = `
            <form action="app/posts/edit-comment.php" method="post" class="comment-form">
                            <div class="comment-field">
                                <input type="hidden" name="postid" value="${postId}">
                                <input class="comment-input" type="text" name="comment" value="${comment}" autocomplete="off">
                                <button class="send-comment" type="submit">Update</button>
                            </div>
                        </form>
            `;
        }
        if (e.target.dataset.type === "delete") {
            e.preventDefault();
            if (
                window.confirm("Are you sure you want to delete the comment?")
            ) {
                const deleteForm = document.querySelector(".delete-form");
                var formData = new FormData(deleteForm);

                fetch("app/posts/delete-comment.php", {
                    method: "POST",
                    body: formData
                })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(response) {
                        if (response === "true") {
                            e.path[2].innerHTML = "";
                        } else {
                        }
                    });
            }
        }
    });
});
