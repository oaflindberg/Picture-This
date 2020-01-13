const commentForms = document.querySelectorAll('.comment-form');

commentForms.forEach(commentForm => {
    commentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(commentForm);

        fetch('/app/posts/comment.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                const inputField = e.target.querySelector('.comment-field .comment-input');
                inputField.value = ''
                const user = json[0];
                const commentText = json[1]
                const list = e.target.parentElement.querySelector('ul')
                const listItem = document.createElement('li');
                listItem.textContent = `${user.firstname} ${user.lastname}: ${commentText}`
                list.appendChild(listItem);
    
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});