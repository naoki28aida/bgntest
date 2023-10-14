document.addEventListener('DOMContentLoaded', function() {
    var message = document.getElementById("popupMessage").getAttribute("data-message");
    if(message && message !== "") {
        document.getElementById("popupText").textContent = message;
        document.getElementById("popupMessage").style.display = 'block';

        // 5秒後に消す
        setTimeout(function(){
            document.getElementById("popupMessage").style.display = 'none';
        }, 5000);
    }
});
