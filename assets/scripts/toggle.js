const icons = document.querySelectorAll('.comment');

icons.forEach(icon => {
    icon.addEventListener('click', (e) => {
        const commentField = e.target.parentElement.parentElement.querySelector('.hidden');
        commentField.classList.toggle('show');    
    })
});

