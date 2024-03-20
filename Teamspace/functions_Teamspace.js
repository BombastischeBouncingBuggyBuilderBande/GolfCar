//import("../funktionen.js")
//document.getElementById("Teamspace-display").classList.add("fade-in");


document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");
    form.onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        fetch('Teamspace/Teamspace_login.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => processData(data))
            .catch(error => console.error('Error:', error));
    };
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("deleteEintragForm");
    form.onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        fetch('Teamspace/Teamspace_delete.php', {
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
        document.getElementById("Teamspace-view").style.display = "block";
        document.getElementById("Teamspace-view").innerHTML = '<?php include("Teamspace/Teamspace_view.php") ?>';
        //toggleFadeIn(document.getElementById("Teamspace-display"));
        loadPerson();
    }else{
        document.getElementById("loginResult").innerHTML = "wrong username or password";
    }

}

function loadPerson(username, password){

}
