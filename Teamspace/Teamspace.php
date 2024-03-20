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
        <h2 id="welcomeText">Logged In</h2>
        <div id="entries"></div>
    </div>
</div>
<script>
    function logout(){
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
