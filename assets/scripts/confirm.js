const deleteBtn = document.querySelector('.delete-btn');

deleteBtn.addEventListener('click', (e) => {
    const confirmPopup = window.confirm('Are you sure you want to delete your account?');
    if (!confirmPopup) {
        e.preventDefault();
    }
});