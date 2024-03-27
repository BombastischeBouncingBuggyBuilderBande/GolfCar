<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Setzt den Titel der Webseite im Browser-Tab -->
    <title>Bombastic</title>
    <!-- Verknüpft ein externes CSS-Stylesheet für das Styling der Webseite -->
    <link rel="stylesheet" href="style.css">
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="description" content="Schulprojekt Golfcar der Gruppe 6B-Engineering. D
    as Ziel: Ein selbstfahrendes Auto zu bauen, das einen Golfball automatisch in eine Box befördert">
    <meta name="robots" content="Golfcar, Car, Automatic Driving, School Project, 6B-Engineering">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Patrick Priller">

    <!-- Open Graph Tags (Facebook und andere Social media) -->
    <meta property="og:title" content="6B-Engineering">
    <meta property="og:description" content="Schulprojekt Golfcar der Gruppe 6B-Engineering. D
    as Ziel: Ein selbstfahrendes Auto zu bauen, das einen Golfball automatisch in eine Box befördert">
    <meta property="og:image" content="icon.jpg">
    <meta property="og:url" content="10.10.30.14"> <!-- to insert ---------------------------------------------------->

    <!-- Twitter Cards -->
    <meta name="twitter:title" content="6B-Engineering">
    <meta name="twitter:description" content="Schulprojekt Golfcar der Gruppe 6B-Engineering. D
    as Ziel: Ein selbstfahrendes Auto zu bauen, das einen Golfball automatisch in eine Box befördert">
    <meta name="twitter:image" content="icon.jpg">
    <meta name="twitter:card" content="toinsert"> <!-- to insert ----------------------------------------------------->

</head>
<body>
<!-- Einbindung der JavaScript-Datei mit grundlegenden Funktionen -->
<script src="funktionen.js"></script>
<!-- Einbindung einer weiteren JavaScript-Datei für spezielle Funktionen für Index.php -->
<script src="mainFunktionen.js"></script>

<?php
// Startet die Output Buffering-Funktion, um später im Code Header-Informationen senden zu können
ob_start();
// Überprüft, ob ein 'page'-Parameter in der URL gesetzt ist
if(isset($_GET['page'])) {
    $getted = $_GET['page'];
    // Überprüft den Wert des 'page'-Parameters gegen eine Liste gültiger Seiten
    // Leitet den Benutzer um, falls der Wert nicht in der Liste ist
    if (!($getted === "home" || $getted === "team" || $getted == "downloads" || $getted == "live" || $getted === "teamspace" || $getted === "bauteile")) {
        header('Location: pageException.php');
        exit;
    }
}
// Beendet die Output Buffering-Funktion und sendet alle ausgegebenen Daten an den Browser
ob_end_flush();
?>

<div id="mainContainer">
    <!-- Navigation der Webseite, ermöglicht Benutzern das Wechseln zwischen den Seiten -->
    <ul id="menuContainer">
        <!-- Jeder Link ruft eine JavaScript-Funktion auf, um nur den entsprechenden Inhaltsteil anzuzeigen -->
        <li><a class="nav-link" id="Home" onclick="deactivate_all_but('home-display')" background-text="Home" data-text="Home">Home</a></li>
        <li><a class="nav-link" id="Team" onclick="deactivate_all_but('team-display')" background-text="Team" data-text="Team">Team</a></li>
        <li><a class="nav-link" id="Downloads" onclick="deactivate_all_but('downloads-display')" background-text="Downloads" data-text="Downloads">Downloads</a></li>
        <li><a class="nav-link" id="Bauteile" onclick="deactivate_all_but('bauteile-display')" background-text="Bauteile" data-text="Bauteile">Bauteile</a></li>
        <li><a class="nav-link" id="Live" onclick="deactivate_all_but('live-display')" background-text="Live" data-text="Live">Live</a></li>
        <li><a class="nav-link" id="Teamspace" onclick="deactivate_all_but('teamspace-display')" background-text="Teamspace" data-text="Teamspace">Teamspace</a></li>
        <li><a class="nav-link" id="Contact" onclick="deactivate_split_mode()" href="mailto:stweiren@bx.fallmerayer.it?subject=Contact" background-text="Contact" data-text="Contact">Contact</a></li>
    </ul>

    <!-- Bereich für die Anzeige von Inhalten basierend auf der Auswahl in der Navigation -->
    <div id="informationsContainer">
        <div id="home-display" class="fade-in">
            <?php include("Home/home.php"); ?>
        </div>
        <div id="team-display" class="fade-in">
            <?php include("Team/team.php"); ?>
        </div>
        <div id="downloads-display" class="fade-in">
            <?php include("Downloads/downloads.php"); ?>
        </div>
        <div id="bauteile-display" class="fade-in">
            <?php include("Bauteile/bauteile.php"); ?>
        </div>
        <div id="live-display" class="fade-in">
            <?php include("Live/live.php"); ?>
        </div>
        <div id="teamspace-display" class="fade-in">
            <?php include("Teamspace/Teamspace.php"); ?>
        </div>
        <!--
        <div id="Contact" class="fade-in">
            <?php include("Contact/Contact.php"); ?>
        </div>
        -->
    </div>
</div>

<!-- Externer Link zu einem Sponsor mit dazugehörigem Bild -->
<a href="https://www.ris.bz.it/de/" target="_blank"><img id="sponsorImg" class="animate-image" src="resources/ris_logo.png" alt="Our Sponsor"></a>

<?php
// Überprüft erneut den 'page'-Parameter und führt eine Aktion basierend auf dem Wert aus
if(isset($_GET['page'])) {
    $getted = $_GET['page'];
    // Protokolliert den aktuellen 'page'-Parameter in der Konsole des Browsers
    echo "<script>console.log('page Parameter: ' + '$getted')</script>";

    // Ruft JavaScript-Funktionen auf, um den richtigen Inhaltsteil zu aktivieren und den Split-Modus zu aktivieren
    if ($getted === "home" || $getted === "team" || $getted == "downloads" || $getted == "live" || $getted === "teamspace" || $getted === "bauteile") {
        echo "<script> 
        deactivate_all_but('$getted' + '-display');
        activate_split_mode();
    </script>";
    }
}
?>
</body>
</html>
