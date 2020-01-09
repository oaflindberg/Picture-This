const likeForms = document.querySelectorAll('.like-form');

likeForms.forEach(likeForm => {
    likeForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(likeForm);

        fetch('http://localhost:1337/app/posts/reactions.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(json => {
                const heart = likeForm.querySelector('button img');
                heart.src = `/assets/icons/${json.src}`
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
});

