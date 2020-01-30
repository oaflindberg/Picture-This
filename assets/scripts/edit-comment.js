const commentOptionsButtons = document.querySelectorAll(".comment-options");

function commentOptions(e) {
    const comment = e.path[1].children[0].textContent.split(":")[1];
    const postId = e.target.dataset.postid;
    const commentId = e.target.dataset.id;

    //edits comment
    if (e.target.dataset.type === "edit") {
        e.path[1].innerHTML = `
            <form action="app/posts/edit-comment.php" method="post" class="comment-form-edit">
                <div class="comment-field">
                    <input type="hidden" name="postid" value="${postId}">
                    <input type="hidden" name="id" value="${commentId}">
                    <input class="comment-input" type="text" name="comment-edit" value="${comment}" autocomplete="off">
                    <button class="send-comment" type="submit">Update</button>
                </div>
             </form>
        `;

        const editForm = document.querySelector(".comment-form-edit");

        editForm.addEventListener("submit", event => {
            event.preventDefault();

            var formData = new FormData(editForm);

            fetch("app/posts/edit-comment.php", {
                method: "POST",
                body: formData
            })
                .then(response => {
                    return response.json();
                })
                .then(response => {
                    if (response[0] === "true") {
                        const user = response[1];
                        console.log(response);
                        const commentText1 = response[2];
                        const commentid = response[3];
                        const postid = response[4];
                        const template = `
                <p class="comment">${user.firstname} ${user.lastname}: ${commentText1}</p>
                <form class="delete-form" method="post">
                    <input class="hidden" type="hidden" name="commentid" value="${commentid}">
                    <button class="comment-options" data-postId="${postid}" data-type="delete">Delete</button>
                </form>

                <button class="comment-options" data-postId="${postid}" data-id="${commentid}" data-type="edit">Edit</button>`;

                        e.path[1].innerHTML = template;
                        const commentOptionsButtons = document.querySelectorAll(
                            ".comment-options"
                        );
                        commentOptionsButtons.forEach(commentButton => {
                            commentButton.addEventListener("click", e => {
                                commentOptions(e);
                            });
                        });
                    } else {
                        window.alert("Something unexpected happend");
                    }
                });
        });
    }

    //deletes comment
    if (e.target.dataset.type === "delete") {
        e.preventDefault();
        const deleteForm = e.target.form;
        var formData = new FormData(deleteForm);

        fetch("app/posts/delete-comment.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(response => {
                if (response === "true") {
                    e.path[2].remove();
                } else {
                    window.alert("Something unexpected happend");
                }
            });
    }
}

commentOptionsButtons.forEach(commentButton => {
    commentButton.addEventListener("click", e => {
        commentOptions(e);
    });
});
