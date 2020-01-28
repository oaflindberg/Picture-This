const icons = document.querySelectorAll(".comment");

icons.forEach(icon => {
    icon.addEventListener("click", e => {
        const commentField = e.target.parentElement.parentElement.querySelector(
            ".comment-input"
        );
        const sendComment = e.target.parentElement.parentElement.querySelector(
            ".send-comment"
        );
        commentField.classList.toggle("show");
        sendComment.classList.toggle("show-send");
        commentField.focus();
    });
});

const sendBtns = document.querySelectorAll(".send-comment");

sendBtns.forEach(sendBtn => {
    sendBtn.addEventListener("click", e => {
        const commentField = e.target.parentElement.parentElement.querySelector(
            ".hidden"
        );
        const sendComment = e.target.parentElement.parentElement.querySelector(
            ".send-comment"
        );
        commentField.classList.toggle("show");
        sendComment.classList.toggle("show-send");
    });
});
