const commentForms = document.querySelectorAll('.comment-form');

commentForms.forEach(commentForm => {
    commentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(commentForm);

        fetch('http://localhost:1337/app/posts/comment.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                const inputField = e.target.querySelector('.comment-field .comment-input');
                inputField.value = ''
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});