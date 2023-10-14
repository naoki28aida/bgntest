window.addEventListener('DOMContentLoaded', function() {
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
        setTimeout(function() {
            alertMessage.style.opacity = "0";
            setTimeout(function() {
                alertMessage.remove();
            }, 1000);
        }, 4000);
    }
});
