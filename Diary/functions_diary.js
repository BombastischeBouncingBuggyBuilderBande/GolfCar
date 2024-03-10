//import("../funktionen.js")
//document.getElementById("diary-display").classList.add("fade-in");


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
            .then(data => processData(data))
            .catch(error => console.error('Error:', error));
    };
});

function  processData(data){
    if(data === "true"){
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("diary-view").style.display = "block";
        document.getElementById("diary-view").innerHTML = '<?php include("Diary/diary_view.php") ?>';
        //toggleFadeIn(document.getElementById("diary-display"));
        loadPerson();
    }else{
        document.getElementById("loginResult").innerHTML = "wrong username or password";
    }

}

function loadPerson(username, password){

}
