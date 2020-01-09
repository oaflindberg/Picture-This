const icons = document.querySelectorAll('.comment');

icons.forEach(icon => {
    icon.addEventListener('click', (e) => {
        const commentField = e.target.parentElement.parentElement.querySelector('.hidden');
        const sendComment = e.target.parentElement.parentElement.querySelector('.send-comment');
        commentField.classList.toggle('show');
        sendComment.classList.toggle('show-send');
    })
});

