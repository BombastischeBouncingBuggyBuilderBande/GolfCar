<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Teamspace/style_Teamspace.css">
</head>
<body>
<div id="TeamspaceContainer">
    <div id="Diary-part">
        <div id="loginForm">
            <h2>Login</h2>
            <form id="formLogin">
                <input type="text" id="username" name="username" placeholder="Benutzername">
                <input type="password" id="password" name="password" placeholder="Passwort">
                <button type="submit">Anmelden</button>
            </form>
        </div>

        <div id="userEntries" style="display:none;">
            <button id="logoutButton" onclick="logout()">Log out</button>
            <button id="controlButton" onclick="toggle_Teamspace()">Control</button>
            <h2 id="welcomeText">Logged In</h2>
            <div id="entries"></div>
        </div>
    </div>
    <div id="Control-part" style="display: none">
        <div id="Control-information">
            <div id="Teamspace-CarInterface">
                <div id="Control-Car-VideoContainer">
                    <video id="Teamspace-videoPlayer" controls>
                        <source src="Live/video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div id="fallbackMessage">Cam not currently available</div>
                </div>
                <div id="Teamspace-Car-Control">
                    <div></div>
                    <button class="Control-Button">W</button>
                    <div></div>
                    <button class="Control-Button">A</button>
                    <button class="Control-Button">S</button>
                    <button class="Control-Button">D</button>
                </div>
            </div>
            <div id="Teamspace-Settings" style="display: none">

            </div>
        </div>
        <div id="Control-Navigation">
            <button id="logoutButton" onclick="logout()">Log out</button>
            <button id="controlButton" onclick="toggle_Teamspace()">Diary</button>
        </div>
    </div>
</div>
<script>

    function toggle_Teamspace() {
        let diary = document.getElementById("Diary-part");
        let control = document.getElementById("Control-part");

        if(diary.style.display === "none"){
            diary.style.display = "block";
            control.style.display = "none";
        }else{
            diary.style.display = "none";
            control.style.display = "flex";
        }
    }


    function logout(){
        if(document.getElementById("Diary-part").style.display === "none"){
            toggle_Teamspace();
        }
        console.log("log out");
        $("#loginForm").show();
        $("#userEntries").hide();
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
    }
    $(document).ready(function(){
        $("#formLogin").on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: "POST",
                url: "Teamspace/Form_login.php", // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
                data: $(this).serialize(),
                success: function(response){
                    // Die Antwort des Servers verarbeiten
                    var jsonData = JSON.parse(response);

                    if (jsonData.success === 1) {
                        $("#loginForm").hide();
                        $("#userEntries").show();
                        $("#entries").html(jsonData.entries);
                        document.getElementById("welcomeText").innerText = "Welcome, " + document.getElementById("username").value;
                    } else {
                        alert("Falsche Anmeldedaten.");
                    }
                }
            });
        });
    });
</script>
</body>
</html>
