<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bombastic</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script src="funktionen.js"></script> <!-- Einbinden allgemeiner Funktionen -->
<?php
// Abfragen für page Parameter (wenn dieser Falsch ist, wird auf eine andere Website weitergeleitet (header() funktioniert nur am Anfang)
ob_start();
if(isset($_GET['page'])) {
    $getted = $_GET['page'];
    if (!($getted === "home" || $getted === "about" || $getted == "downloads" || $getted == "live" || $getted === "diary" || $getted === "control")) {
        header('Location: pageException.php');
        exit;
    }
}
ob_end_flush()
?>
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
<a href="https://www.ris.bz.it/de/"  target="_blank"><img id="sponsorImg" class="animate-image" src="resources/ris_logo.png" alt="Our Sponsor"></a>

    <script src="mainFunktionen.js"></script>
    <?php
    if(isset($_GET['page'])) {
        $getted = $_GET['page'];
        echo"<script>console.log('page Parameter: ' + '$getted')</script>";

        if ($getted === "home" || $getted === "about" || $getted == "downloads" || $getted == "live" || $getted === "diary" || $getted === "control") {
            echo "<script> 
        deactivate_all_but('$getted' + '-display');
        activate_split_mode();
    </script>";
        }
    }
    ?>
</body>
</html>