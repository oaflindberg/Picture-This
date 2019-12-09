'use strict';

const logout = document.querySelector('.logout');

logout.addEventListener('click', (e) => {
    const areYouSure = window.confirm('Are you sure you want to log out?');
    if (!areYouSure) {
        e.preventDefault();
    }
})
