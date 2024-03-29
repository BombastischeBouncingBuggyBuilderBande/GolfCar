// Autor: [Name oder Team, das diesen Teil implementiert hat]
// Beschreibung: Enthält Funktionen zum Ein- und Ausblenden von Elementen mittels CSS-Klassen.

/**
 * Fügt einem Element die Klasse 'visible' hinzu, um einen Fade-In-Effekt zu erzeugen.
 * @param {HTMLElement} element - Das HTML-Element, das eingeblendet werden soll.
 */
function toggleFadeIn(element) {
    // Ursprünglich dazu gedacht, das Element-Display auf 'block' zu setzen, bevor die Klasse hinzugefügt wird.
    // Auskommentiert aufgrund von Layout-Problemen, die dadurch verursacht wurden.
    console.log("fade-in"); // Loggen des Fade-In Vorgangs für Debugging-Zwecke.
    requestAnimationFrame(() => {
        element.classList.add('visible'); // Hinzufügen der Klasse 'visible' für den Fade-In-Effekt.
    });
}

/**
 * Entfernt die Klasse 'visible' von einem Element, um einen Fade-Out-Effekt zu erzeugen.
 * @param {HTMLElement} element - Das HTML-Element, das ausgeblendet werden soll.
 */
function toggleFadeOut(element) {
    requestAnimationFrame(() => {
        element.classList.remove('visible'); // Entfernen der Klasse 'visible' für den Fade-Out-Effekt.
    });
    // Hinzufügen eines EventListeners für das Ende der Transition.
    element.addEventListener('transitionend', function handleTransitionEnd() {
        // Entfernen des EventListeners, um sauberes Garbage Collection zu gewährleisten.
        element.removeEventListener('transitionend', handleTransitionEnd);
    });
}
