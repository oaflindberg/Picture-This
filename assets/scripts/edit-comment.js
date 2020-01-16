const commentOptions = document.querySelectorAll(".comment-options");

commentOptions.forEach(commentButton => {
    commentButton.addEventListener("click", e => {
        if (e.target.dataset.type === "edit") {
            const comment = e.path[1].children[0].textContent.split(":")[1];
            console.log(comment);
            e.path[1].innerHTML = `
            <form action="app/posts/edit-comment.php" method="post" class="comment-form">
                            <div class="comment-field">
                                <input type="hidden" name="postid" value="<?php echo $post['id'] ?>">
                                <input class="comment-input" type="text" name="comment" value="${comment}" autocomplete="off">
                                <button class="send-comment" type="submit">Send</button>
                            </div>
                        </form>
            `;
        }
        if (e.target.dataset.type === "delete") {
            console.log(e);
        }
    });
});
