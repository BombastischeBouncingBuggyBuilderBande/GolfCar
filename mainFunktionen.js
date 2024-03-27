// Definiert ein Array mit den Namen der Hauptnavigationselemente der Website.
let background_text = ["Home", "About", "Downloads", "Bauteile", "Live", "Teamspace"];

/**
 * Deaktiviert den Hintergrundtext der Navbar-Links.
 * Diese Funktion wird aufgerufen, um die Anzeige von Hintergrundtexten zu entfernen,
 * die normalerweise beim Hover über Navbar-Elementen erscheinen.
 */
function deactivate_background_text() {
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
    let allmenu = document.getElementsByClassName("nav-link");
    // Durchläuft alle gefundenen Navbar-Links und setzt deren Hintergrundtext.
    for (let i = 0; i < allmenu.length; i++) {
        allmenu[i].setAttribute('background-text', background_text[i]);
    }
}

/**
 * Deaktiviert alle Infotexte, außer dem ausgewählten.
 * @param {string} but - Die ID des Infotextes, der aktiv bleiben soll.
 * Deaktiviert alle Infotext-Elemente und aktiviert dann nur den spezifizierten Infotext.
 */
function deactivate_all_but(but) {
    // Überprüft, ob das ausgewählte Element bereits angezeigt wird, und beendet die Funktion frühzeitig, falls ja.
    if (document.getElementById(but).style.display === "flex") {
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
            console.log(textPart);
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
    document.getElementById("mainContainer").style.gridTemplateColumns = "20vw 70vw";
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
    document.getElementById("informationsContainer").style.display = "none";
    document.getElementById("mainContainer").style.gridTemplateColumns = "100vw 0";
    console.log("seitenverhältnis geändert");
    deactivate_all_display();
    setTimeout(function() {
        activate_background_text();
    }, 500);

    // Reversiert die Animation für das Sponsor-Image.
    let sponsorImg = document.getElementById("sponsorImg");
    sponsorImg.style.left = "calc(50% - (20%/2))";
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
        toggleFadeOut(document.getElementById((background_text[i].toLowerCase() + "-display").toString()));
        setTimeout(function() {
            document.getElementById((background_text[i].toLowerCase() + "-display").toString()).style.display = "none";
        }, 1000);
    }
}

/**
 * Versteckt den Sponsor-Bereich.
 * Diese Funktion wird aufgerufen, um den Container des Sponsors auszublenden.
 */
function hideSponsor() {
    document.getElementById("SponsorContainer").style.display = "none";
}
