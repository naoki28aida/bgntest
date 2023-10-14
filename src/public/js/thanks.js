document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('re__message');
    if (flashMessage) {
        flashMessage.style.textAlign = 'center';
        flashMessage.style.fontSize = '20px';
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 3000);
    }
});
