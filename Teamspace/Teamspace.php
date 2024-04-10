<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src="functions_Teamspace.js"></script>
    <script src="Teamspace/functions_Teamspace.js"></script>
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
            <section id="Teamspace-ControlPage-1">
                <h2>Car Control</h2>
                <div id="Control-Car-VideoContainer">
                    <div id="videoContainer">
                        <iframe id="videoFrame_control" onload="showFallbackMessage()" src="http://bombastisch:5000"></iframe>
                        <div id="fallbackMessage_control">Streaming not available</div>
                    </div>
                </div>
                <div class="Teamspace-Car-Control">
                    <button class="control-GridItem1 control-gridSpecial" id="control-btn-grab">grab</button>
                    <button class="control-GridItem2 control-gridSpecial" id="control-btn-release">release</button>
                    <div class="control-GridItem3 control-gridPH" style="visibility: hidden;">a</div>
                    <div class="control-GridItem4 control-gridPH" style="visibility: hidden;">b</div>
                    <button class="control-GridItem5 control-gridColor" id="control-btn-a">&#8592</button>
                    <button class="control-GridItem6 control-gridColor" id="control-btn-d">&#8594</button>
                    <button class="control-GridItem7 control-gridColor" id="control-btn-w">&#8593</button>
                    <button class="control-GridItem8 control-gridColor" id="control-btn-s">&#8595</button>
                </div>
            </section>
            <section id="Teamspace-ControlPage-2" style="display: none">
                <h2>Settings</h2>
                
                <div class="Teamspace-Control-Settings" id="Teamspace-Control-Settings-1">
                    <a class="Teamspace-Control-Text">Live Cam</a>
                    <label class="switch">
                        <input id="liveCheckbox" onclick="handleCheckbox('live')" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
                <hr>
                <div class="Teamspace-Control-Settings" id="Teamspace-Control-Settings-2">
                    <a class="Teamspace-Control-Text">Downloads</a>
                    <label class="switch">
                        <input id="downloadsCheckbox" onclick="handleCheckbox('downloads')" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
                <hr>
                <div class="Teamspace-Control-Settings" id="Teamspace-Control-Settings-4">
                    <a class="Teamspace-Control-Text">Bauteile</a>
                    <label class="switch">
                        <input id="bauteileCheckbox" onclick="handleCheckbox('bauteile')" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </section>
        </div>
        <div id="Control-Navigation">
            <button id="logoutButton" onclick="logout()">Log out</button>
            <button id="controlButton" onclick="toggle_Teamspace()">Diary</button>
        </div>
        <div id="control-buttonHolder">
            <button id="control-BottomButton-1" class="controlButtons underlined" onclick="change_control_info(1)"></button>
            <button id="control-BottomButton-2" class="controlButtons" onclick="change_control_info(2)"></button>
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
                        console.log(jsonData.entries());
                    }
                }
            });
        });
    });
</script>
</body>
</html>
