<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script src="funktionen.js"></script>
<script>
    let background_text = ["Home", "About", "Coding", "Live", "Diary", "Contact"];

    function deactivate_background_text() {
        let allmenu = document.getElementsByClassName("nav-link");
        for (let i = 0; i < allmenu.length; i++) {
            allmenu[i].setAttribute('background-text', "");
        }
    }

    function activate_background_text() {
        let allmenu = document.getElementsByClassName("nav-link");
        for (let i = 0; i < allmenu.length; i++) {
            allmenu[i].setAttribute('background-text', background_text[i]);
        }
    }

    function deactivate_all_but(but) {
        if (document.getElementById(but).style.display === "block") {
            console.log("imhere------------------------------------------------------------");
            deactivate_split_mode();
            return 0;
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

    function activate_split_mode() {
        document.getElementById("informationsContainer").style.display = "block";
        document.getElementById("mainContainer").style.gridTemplateColumns = "30vw 70vw";
        deactivate_background_text();

    }

    function deactivate_split_mode() {
        document.getElementById("informationsContainer").style.display = "none";
        document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0vw";
        activate_background_text();
        deactivate_all_display();
    }

    function deactivate_all_display() {
        for (let i = 0; i < background_text.length; i++) {
            toggleFadeOut(document.getElementById((background_text[i].toLowerCase() + "-display").toString()));
            document.getElementById((background_text[i].toLowerCase() + "-display").toString()).style.display = "none";
        }
    }
</script>
<div id="mainContainer">
    <ul id="menuContainer">
        <li><a class="nav-link" id="Home" onclick="deactivate_all_but('home-display')" background-text="Home"
               data-text="Home">Home</a></li>
        <li><a class="nav-link" id="About" onclick="deactivate_all_but('about-display')" background-text="About"
               data-text="About">About</a></li>
        <li><a class="nav-link" id="Coding" onclick="deactivate_all_but('coding-display')" background-text="Coding"
               data-text="Coding">Coding</a></li>
        <li><a class="nav-link" id="Live" onclick="deactivate_all_but('live-display')" background-text="Live"
               data-text="Live">Live</a></li>
        <li><a class="nav-link" id="Diary" onclick="deactivate_all_but('diary-display')" background-text="Diary"
               data-text="Diary">Diary</a></li>
        <li><a class="nav-link" id="Contact" onclick="deactivate_all_but('contact-display')" background-text="Contact"
               data-text="Contact">Contact</a></li>
    </ul>
    <div id="informationsContainer">
        <div id="home-display" class="fade-in">
            <?php
            include("home.php");
            ?>
        </div>
        <div id="about-display" class="fade-in">
            <?php
            include("about.php");
            ?>
        </div>
        <div id="coding-display" class="fade-in">
            <?php
            include("code.php");
            ?>
        </div>
        <div id="live-display" class="fade-in">
            <?php
            include("live.php");
            ?>
        </div>
        <div id="diary-display" class="fade-in">
            <?php
            include("diary.php");
            ?>
        </div>
        <div id="contact-display" class="fade-in">
            <?php
            include("contact.php");
            ?>
        </div>

    </div>
</div>
<script>
    document.querySelectorAll('.nav-link').forEach(item => {
        item.addEventListener('click', function () {
            let link = this.getAttribute('data-text');
            if (link === "Home" || link === "About" || link === "Coding" || link === "Live" || link === "Diary" || link === "Content") {
                activate_split_mode()
            }
        });
    });
</script>
</body>
</html>