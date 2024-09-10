document.querySelectorAll('.btn-primary').forEach(button => {
    button.addEventListener('click', function() {
        this.classList.add('btn-loading');
    });
});

document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.classList.add('input-focus');
    });
    input.addEventListener('blur', () => {
        input.parentElement.classList.remove('input-focus');
    });
});
