<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div id="loginForm">
    <h2>Login</h2>
    <form id="formLogin">
        <input type="text" id="username" name="username" placeholder="Benutzername">
        <input type="password" id="password" name="password" placeholder="Passwort">
        <button type="submit">Anmelden</button>
    </form>
</div>

<div id="userEntries" style="display:none;">
    <h2>Einträge</h2>
    <div id="entries"></div>
</div>

<script>
    $(document).ready(function(){
        $("#formLogin").on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: "POST",
                url: "Diary/login.php", // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
                data: $(this).serialize(),
                success: function(response){
                    // Die Antwort des Servers verarbeiten
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == "1") {
                        $("#loginForm").hide();
                        $("#userEntries").show();
                        $("#entries").html(jsonData.entries);
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
