<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bombastic</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script src="funktionen.js"></script> <!-- Einbinden allgemeiner Funktionen -->

<div id="mainContainer">
    <!-- Navbar ------------------------------------------------------------------------------------------------------>
    <ul id="menuContainer">
        <li><a class="nav-link" id="Home" onclick="deactivate_all_but('home-display')" background-text="Home"
               data-text="Home">Home</a></li>
        <li><a class="nav-link" id="About" onclick="deactivate_all_but('about-display')" background-text="About"
               data-text="About">About</a></li>
        <li><a class="nav-link" id="Downloads" onclick="deactivate_all_but('downloads-display')" background-text="Downloads"
               data-text="Downloads">Downloads</a></li>
        <li><a class="nav-link" id="Live" onclick="deactivate_all_but('live-display')" background-text="Live"
               data-text="Live">Live</a></li>
        <li><a class="nav-link" id="Diary" onclick="deactivate_all_but('diary-display')" background-text="Diary"
               data-text="Diary">Diary</a></li>
        <li><a class="nav-link" id="Control" onclick="deactivate_all_but('control-display')" background-text="Control"
               data-text="Control">Control</a></li>
    </ul>

    <!-- Linker Informationsteil der Website ------------------------------------------------------------------------->
    <div id="informationsContainer">
        <div id="home-display" class="fade-in">
            <?php
            include("Home/home.php");
            ?>
        </div>
        <div id="about-display" class="fade-in">
            <?php
            include("About/about.php");
            ?>
        </div>
        <div id="downloads-display" class="fade-in">
            <?php
            include("Downloads/downloads.php");
            ?>
        </div>
        <div id="live-display" class="fade-in">
            <?php
            include("Live/live.php");
            ?>
        </div>
        <div id="diary-display" class="fade-in">
            <?php
            include("Diary/diary.php");
            ?>
        </div>
        <div id="control-display" class="fade-in">
            <?php
            include("Control/control.php");
            ?>
        </div>
    </div>
</div>
<script>
    // Array mit allen Elementen der Navbar (Hauptelemente der Website)
    let background_text = ["Home", "About", "Downloads", "Live", "Diary", "Control"];

    // Deaktiviert den Text der Hinter der Navbar erscheint, wenn man darüberhovert
    function deactivate_background_text() {
        let allmenu = document.getElementsByClassName("nav-link");
        for (let i = 0; i < allmenu.length; i++) {
            allmenu[i].setAttribute('background-text', "");
        }
    }

    // Aktiviert den Text der Hinter der Navbar erscheint, wenn man darüberhovert
    function activate_background_text() {
        let allmenu = document.getElementsByClassName("nav-link");
        for (let i = 0; i < allmenu.length; i++) {
            allmenu[i].setAttribute('background-text', background_text[i]);
        }
    }

    // Deaktiviert jeden Infotext (Information die auf der linken Seite angezeigt wird), außer den der ausgewählt wird
    function deactivate_all_but(but) {
        if (document.getElementById(but).style.display === "block") {
            deactivate_split_mode();
            return 0;
        }else{
            activate_split_mode()
        }
        for (let i = 0; i < background_text.length; i++) {
            let textPart = "" + background_text[i].toLowerCase() + "-display";

            if (textPart !== but) {
                document.getElementById(background_text[i].toLowerCase() + "-display").style.display = "none";
                toggleFadeOut(document.getElementById(background_text[i].toLowerCase() + "-display"));
            } else {
                document.getElementById(background_text[i].toLowerCase() + "-display").style.display = "block";
                console.log(textPart);
                toggleFadeIn(document.getElementById(background_text[i].toLowerCase() + "-display"));
            }
        }
    }

    // Bewegt die Navbar nach links und lässt rechts davon den Infotext erscheinen
    function activate_split_mode() {
        document.getElementById("informationsContainer").style.display = "block";
        document.getElementById("mainContainer").style.gridTemplateColumns = "30vw 70vw";
        console.log("seitenverhältnis geändert");
        deactivate_background_text();

    }

    // Generiert die Ursprungsform der Website, mit nur der Navbar in der Mitte
    function deactivate_split_mode() {
        console.log("deactivating split mode");
        document.getElementById("informationsContainer").style.display = "none";
        document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0"; // informationsteil der Website wird ausgeblendet
        console.log("seitenverhältnis geändert");
        deactivate_all_display();
        setTimeout(function() {
            activate_background_text();
        }, 500);
    }

    // Deaktiviert das Display aller Informationen
    function deactivate_all_display() {
        for (let i = 0; i < background_text.length; i++) {
            toggleFadeOut(document.getElementById((background_text[i].toLowerCase() + "-display").toString()));
            document.getElementById((background_text[i].toLowerCase() + "-display").toString()).style.display = "none";
        }
    }
</script>
</body>
</html>