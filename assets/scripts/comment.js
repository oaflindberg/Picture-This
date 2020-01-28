const commentForms = document.querySelectorAll(".comment-form");

commentForms.forEach(commentForm => {
    commentForm.addEventListener("submit", e => {
        e.preventDefault();
        const formData = new FormData(commentForm);

        fetch("/app/posts/comment.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                const inputField = e.target.querySelector(
                    ".comment-field .comment-input"
                );
                inputField.value = "";
                const user = json[0];
                const commentText = json[1];
                const commentid = json[2];
                const postid = json[3];
                const list = e.target.parentElement.querySelector("ul");
                const listItem = document.createElement("li");
                const template = `
                <p class="comment">${user.firstname} ${user.lastname}: ${commentText}</p>
                <form class="delete-form" method="post">
                    <input class="hidden" type="hidden" name="commentid" value="${commentid}">
                    <button class="comment-options" data-postId="${postid}" data-type="delete">Delete</button>
                </form>

                <button class="comment-options" data-postId="${postid}" data-id="${commentid}" data-type="edit">Edit</button>`;
                listItem.innerHTML = template;
                list.appendChild(listItem);
                const commentOptionsButtons = document.querySelectorAll(
                    ".comment-options"
                );
                commentOptionsButtons.forEach(commentButton => {
                    commentButton.addEventListener("click", e => {
                        commentOptions(e);
                    });
                });
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});
