document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");
    form.onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        fetch('Diary/diary_login.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => document.getElementById("loginResult").innerText = data)
            .catch(error => console.error('Error:', error));
    };
});
