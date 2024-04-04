<!DOCTYPE html>
<html lang="en">
<head>
    <!-- TODO: Ensure the title accurately reflects the content of your website. -->
    <title>Bombastic</title>
    <!-- Verknüpft ein externes CSS-Stylesheet für das Styling der Webseite -->
    <link rel="stylesheet" href="style.css">
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <!-- TODO: Customize the description meta tag to better suit your site's content. -->
    <meta name="description"
          content="Schulprojekt Golfcar der Gruppe 6B-Engineering. Das Ziel: Ein selbstfahrendes Auto zu bauen, das einen Golfball automatisch in eine Box befördert">
    <!-- TODO: Review and adjust the keywords meta tag to include relevant keywords for your site. -->
    <meta name="keywords" content="Golfcar, Car, Automatic Driving, School Project, 6B-Engineering">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TODO: Change the author to the name of the actual author or organization responsible for the website. -->
    <meta name="author" content="Patrick Priller">

    <!-- Open Graph Tags (Facebook und andere Social media) -->
    <!-- TODO: Update the og:title to more accurately represent your site. -->
    <meta property="og:title" content="6B-Engineering">
    <!-- TODO: Ensure the og:description accurately describes your site. -->
    <meta property="og:description"
          content="Schulprojekt Golfcar der Gruppe 6B-Engineering. Das Ziel: Ein selbstfahrendes Auto zu bauen, das einen Golfball automatisch in eine Box befördert">
    <!-- TODO: Replace "icon.jpg" with the path to an image more representative of your site. -->
    <meta property="og:image" content="icon.jpg">
    <!-- TODO: Replace "http://example.com" with the actual URL of your website. -->
    <meta property="og:url" content="http://example.com">

    <!-- Twitter Cards -->
    <!-- TODO: Similar to Open Graph tags, ensure these Twitter card tags accurately represent your site. -->
    <meta name="twitter:title" content="6B-Engineering">
    <meta name="twitter:description"
          content="Schulprojekt Golfcar der Gruppe 6B-Engineering. Das Ziel: Ein selbstfahrendes Auto zu bauen, das einen Golfball automatisch in eine Box befördert">
    <meta name="twitter:image" content="icon.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Google Analytics -->
    <!-- TODO: Replace "G-YOUR_TRACKING_ID" with your actual Google Analytics tracking ID. -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YOUR_TRACKING_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-YOUR_TRACKING_ID');
    </script>
    <!-- End Google Analytics -->
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
if (isset($_GET['page'])) {
    $getted = $_GET['page'];
    // Überprüft den Wert des 'page'-Parameters gegen eine Liste gültiger Seiten
    // Leitet den Benutzer um, falls der Wert nicht in der Liste ist
    if (!($getted === "home" || $getted === "team" || $getted == "downloads" || $getted == "live" || $getted === "teamspace" || $getted === "bauteile" || $getted === "contact")) {
        header('Location: pageException.php');
        exit;
    }
}
// Beendet die Output Buffering-Funktion und sendet alle ausgegebenen Daten an den Browser
ob_end_flush();
?>

<div id="mainContainer">
    <ul id="menuContainer">
        <!-- TODO: Ensure the links and onclick handlers are correctly set up for your site's navigation. -->
        <li><a class="nav-link" id="Home" onclick="deactivate_all_but('home-display')" data-text="Home">Home</a></li>
        <li><a class="nav-link" id="Team" onclick="deactivate_all_but('team-display')" data-text="Team">Team</a></li>
        <li><a class="nav-link" id="Downloads" onclick="deactivate_all_but('downloads-display')" data-text="Downloads">Downloads</a></li>
        <li><a class="nav-link" id="Bauteile" onclick="deactivate_all_but('bauteile-display')" data-text="Bauteile">Bauteile</a></li>
        <li><a class="nav-link" id="Live" onclick="deactivate_all_but('live-display')" data-text="Live">Live</a></li>
        <li><a class="nav-link" id="Teamspace" onclick="deactivate_all_but('teamspace-display')" data-text="Teamspace">Teamspace</a></li>
        <li><a class="nav-link" id="Contact" onclick="deactivate_split_mode()" href="mailto:stweiren@bx.fallmerayer.it?subject=Contact" data-text="Contact">Contact</a></li>
    </ul>
    <div id="manuBar_phone">
        <img id="hamburger-icon" onclick="openHamburger_Phone()" src="resources/Hamburger_icon.png" alt="Hamburger-Menu" width="50" height="50">
        <h2 id="NavbarText-phone">6B-Engineering</h2>
        <img id="profile-icon" onclick="openTeamspace_Phone()" src="resources/profile-icon.svg" alt="profile-icon" width="50" height="50">
    </div>
    <div id="informationsContainer">
        <!-- TODO: Verify and potentially update the included PHP files to ensure they match the content structure of your site. -->
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
    </div>
</div>

<a href="https://www.ris.bz.it/de/" target="_blank"><img id="sponsorImg" class="animate-image" src="resources/ris_logo.png" alt="Our Sponsor"></a>

<?php
if (isset($_GET['page'])) {
    $getted = $_GET['page'];
    echo "<script>console.log('page Parameter: ' + '$getted')</script>";
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
