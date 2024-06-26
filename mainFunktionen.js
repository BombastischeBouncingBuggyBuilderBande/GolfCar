// Definiert ein Array mit den Namen der Hauptnavigationselemente der Website.
let background_text = ["Home", "Team", "Downloads", "Bauteile", "Live", "Teamspace"];

/**
 * Deaktiviert den Hintergrundtext der Navbar-Links.
 * Diese Funktion wird aufgerufen, um die Anzeige von Hintergrundtexten zu entfernen,
 * die normalerweise beim Hover über Navbar-Elementen erscheinen.
 */
function deactivate_background_text() {
    console.log("deactivating background text");
    // Holt alle Navbar-Links durch ihre gemeinsame Klasse.
    let allmenu = document.getElementsByClassName("nav-link");
    // Durchläuft alle gefundenen Navbar-Links, um deren Hintergrundtext zu löschen.
    for (let i = 0; i < allmenu.length; i++) {
        allmenu[i].setAttribute('background-text', "");
    }
}

/**
 * Aktiviert den Hintergrundtext der Navbar-Links basierend auf dem 'background_text' Array.
 * Diese Funktion wird genutzt, um den Hintergrundtext wieder anzuzeigen,
 * der beim Hover über Navbar-Elementen erscheinen soll.
 */
function activate_background_text() {
    // Holt alle Navbar-Links durch ihre gemeinsame Klasse.
    let background_text_temp = [...background_text];
    background_text_temp.push("Contact")
    let allmenu = document.getElementsByClassName("nav-link");
    // Durchläuft alle gefundenen Navbar-Links und setzt deren Hintergrundtext.
    for (let i = 0; i < allmenu.length; i++) {
        allmenu[i].setAttribute('background-text', background_text_temp[i]);
    }
}

/**
 * Deaktiviert alle Infotexte, außer dem ausgewählten.
 * @param {string} but - Die ID des Infotextes, der aktiv bleiben soll.
 * Deaktiviert alle Infotext-Elemente und aktiviert dann nur den spezifizierten Infotext.
 */
function deactivate_all_but(but) {
    if (window.matchMedia("(max-width: 600px)").matches) {
        document.getElementById("menuContainer").style.display = "none";
        document.getElementById("informationsContainer").style.display = "flex";
    }
    // Überprüft, ob das ausgewählte Element bereits angezeigt wird, und beendet die Funktion frühzeitig, falls ja.
    if (document.getElementById(but).style.display === "flex" && window.innerWidth > 600) {
        deactivate_split_mode();
        return 0;
    } else {
        activate_split_mode();
    }
    // Durchläuft das Array mit Hintergrundtexten, um alle entsprechenden Infotexte zu deaktivieren.
    for (let i = 0; i < background_text.length; i++) {
        let textPart = "" + background_text[i].toLowerCase() + "-display";

        if (textPart !== but) {
            document.getElementById(textPart).style.display = "none";
            toggleFadeOut(document.getElementById(textPart));
        } else {
            document.getElementById(textPart).style.display = "flex";
            toggleFadeIn(document.getElementById(textPart));
        }
    }
}

/**
 * Aktiviert den Split-Modus, in dem die Navbar nach links verschoben wird und Infotext rechts angezeigt wird.
 * Diese Funktion verändert das Layout, um einen Bereich für Infotexte neben der Navbar freizugeben.
 */
function activate_split_mode() {
    document.getElementById("informationsContainer").style.display = "flex";
    if(window.innerWidth > 600) {
        document.getElementById("mainContainer").style.gridTemplateColumns = "20vw 70vw";
    }
    document.getElementById("impressum-button").style.display = "block"
    console.log("seitenverhältnis geändert");
    deactivate_background_text();

    // Startet eine Animation für das Sponsor-Image.
    let sponsorImg = document.getElementById("sponsorImg");
    sponsorImg.style.left = "0";
    sponsorImg.classList.add("start-animation");
    sponsorImg.classList.remove("start-animation-reverse");
}

function activate_split_mode_phone() {
    document.getElementById("informationsContainer").style.display = "flex";
    document.getElementById("mainContainer").style.gridTemplateColumns = "auto";
    document.getElementById("mainContainer").style.gridTemplateRows = "10vh 90vh";

    console.log("seitenverhältnis geändert");
    deactivate_background_text();

    // Startet eine Animation für das Sponsor-Image.
    let sponsorImg = document.getElementById("sponsorImg");
    sponsorImg.style.left = "0";
    sponsorImg.classList.add("start-animation");
    sponsorImg.classList.remove("start-animation-reverse");
}

/**
 * Deaktiviert den Split-Modus und stellt das ursprüngliche Layout der Website wieder her.
 * Diese Funktion wird aufgerufen, um zum ursprünglichen Layout zurückzukehren,
 * bei dem nur die Navbar zentral angezeigt wird.
 */
function deactivate_split_mode() {
    console.log("deactivating split mode");
    if(window.innerWidth > 600) { // Desktop sicht
        document.getElementById("mainContainer").style.gridTemplateRows = "auto";
        document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0";
        setTimeout(function() {
            activate_background_text();
        }, 500);
    }else{ // Handy view
        document.getElementById("mainContainer").style.gridTemplateRows = "10vh 90vh";
        document.getElementById("mainContainer").style.gridTemplateColumns = "auto";
    }

    document.getElementById("informationsContainer").style.display = "none";
    document.getElementById("menuContainer").style.display = "block";
    document.getElementById("impressum-button").style.display = "none"

    deactivate_all_display();

    // Reversiert die Animation für das Sponsor-Image.
    let sponsorImg = document.getElementById("sponsorImg");
    if(window.innerWidth > 1250) {
        sponsorImg.style.left = "calc(50% - 125px)";
    }else{
        sponsorImg.style.left = "calc(50% - 10%)";
    }
    sponsorImg.classList.remove("start-animation");
    sponsorImg.classList.add("start-animation-reverse");
}

/**
 * Deaktiviert die Anzeige aller Informations-Elemente.
 * Diese Funktion wird genutzt, um alle Infotexte auszublenden,
 * typischerweise als Teil des Prozesses, das Layout zurückzusetzen.
 */
function deactivate_all_display() {
    for (let i = 0; i < background_text.length; i++) {
        document.getElementById((background_text[i].toLowerCase() + "-display").toString()).style.display = "none";
    }
}

/**
 * Versteckt den Sponsor-Bereich.
 * Diese Funktion wird aufgerufen, um den Container des Sponsors auszublenden.
 */
function hideSponsor() {
    document.getElementById("SponsorContainer").style.display = "none";
}

/* Responsive für Handy */
function checkWidth() {
    let menucontainer = document.getElementById("menuContainer");
    let infocontainer = document.getElementById("informationsContainer");
    if(window.innerWidth > 600) { // Desktop sicht
        document.getElementById("mainContainer").style.gridTemplateRows = "auto";
        document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0";
    }else{ // Handy view
        document.getElementById("mainContainer").style.gridTemplateRows = "10vh 90vh";
        document.getElementById("mainContainer").style.gridTemplateColumns = "auto";
    }
    if (window.innerWidth > 600) {
        document.getElementById("mainContainer").style.gridTemplateRows = "auto";
        document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0";
        menucontainer.style.display = "block";
        if(infocontainer.style.display === "none" || infocontainer.style.display === ""){
            deactivate_split_mode();
        }else{
            activate_split_mode()
        }
    }else{
        deactivate_background_text();
        document.getElementById("mainContainer").style.gridTemplateRows = "10vh 90vh";
        document.getElementById("mainContainer").style.gridTemplateColumns = "auto";
        //document.getElementById("mainContainer").style.gridTemplateRows = "10vw 90vw";

        if(infocontainer.style.display === "" || infocontainer.style.display === "none"){
            menucontainer.style.display = "block";
        }else{
            menucontainer.style.display = "none";
        }
        setTimeout(function() {
            deactivate_background_text();
        }, 500);
    }
}

// Listen for the window resize event
window.addEventListener('resize', checkWidth);
document.addEventListener('DOMContentLoaded', function() {
    checkWidth();
    //updateUiOnJson();
});


function openHamburger_Phone(){
    let menucontainer = document.getElementById("menuContainer");
    let infocontainer = document.getElementById("informationsContainer");
    if(infocontainer.style.display === "none") {
        menucontainer.style.display = "none";
        toggleFadeOut(menucontainer);
        infocontainer.style.display = "flex";
        deactivate_background_text()
        if(nodisplay() === 0){
            console.log(nodisplay() + "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
            deactivate_all_but("home-display");
        }
    }
    else{
        menucontainer.style.display = "block";
        toggleFadeIn(menucontainer);
        infocontainer.style.display = "none";
        //deactivate_all_display()
        deactivate_background_text()
    }
}
function nodisplay(){
    for (let i = 0; i < background_text.length; i++) {
        console.log(background_text[i].toLowerCase() + "-display");
        if(document.getElementById((background_text[i].toLowerCase() + "-display")).style.display === "flex"){
            return 1;
        }
    }
    return 0;
}
function openTeamspace_Phone(){
    let menucontainer = document.getElementById("menuContainer");
    let infocontainer = document.getElementById("informationsContainer");
    let teamspace = document.getElementById("teamspace-display");
    if(infocontainer.style.display === "none" || teamspace.style.display === "none") {
        menucontainer.style.display = "none";
        toggleFadeOut(menucontainer);
        infocontainer.style.display = "flex";
        deactivate_background_text()
        deactivate_all_but("teamspace-display")
    }
    else{
        menucontainer.style.display = "block";
        toggleFadeIn(menucontainer);
        infocontainer.style.display = "none";
        //deactivate_all_display()
        deactivate_background_text()
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const profileIcon = document.getElementById('profile-icon');

    hamburgerIcon.addEventListener('click', openHamburger_Phone);
    profileIcon.addEventListener('click', openTeamspace_Phone);
});

// Impressum
function openImpressum(){
    let impressum = document.getElementById("impressum-display");
    document.getElementById("mainContainer").classList.add("impresumbackground");
    /*impressum.style.display = "block"*/
    toggleFadeIn(impressum)
}
function closeImpressum(){
    let impressum = document.getElementById("impressum-display");
    document.getElementById("mainContainer").classList.remove("impresumbackground");

    /*impressum.style.display = "none"*/
    toggleFadeOut(impressum)
}