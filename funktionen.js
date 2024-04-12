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


async function readJson() {
    const response = await fetch('Teamspace/state.json');
    const jsonData = await response.json();


    let live = document.getElementById("LiveLi");
    let downloads = document.getElementById("DownloadsLi")
    let bauteile = document.getElementById("BauteileLi");

    const liveCheckbox = document.getElementById("liveCheckbox");
    const bauteileCheckbox = document.getElementById("bauteileCheckbox");
    const downloadsCheckbox = document.getElementById("downloadsCheckbox");
    const statesArray = jsonData.States;


    statesArray.forEach(item => {
        console.log(item.name, item.state);
        if (item.name === "live") {
            live.style.display = item.state ? "block" : "none";
            liveCheckbox.checked = item.state;
        } else if (item.name === "downloads") {
            downloads.style.display = item.state ? "block" : "none";
            downloadsCheckbox.checked = item.state;
        } else {
            bauteile.style.display = item.state ? "block" : "none";
            bauteileCheckbox.checked = item.state;
        }

    });
}
//------------------------------ Checkbox -------------------------------------------------------------------------\
// Simulierte Funktion zum Lesen der JSON-Datei
const stateLink = "Teamspace/state.json";
async function readJsonFromFile() {
    const response = await fetch(stateLink);
    return await response.json();
}

// Simulierte Funktion zum Schreiben in die JSON-Datei
async function writeJsonToFile(data) {
    await fetch(stateLink, {
        method: 'POST', // In echtem Code könnte dies POST oder PUT sein, abhängig von der Backend-Implementierung
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
}

// Funktion, die auf Änderungen der Checkbox reagiert
async function updateUiOnChecked(checkboxIdLive = "CheckboxLive", checkboxIdDownloads = "CheckboxBauteile", checkboxIdBauteile = "CheckboxBauteile") {
    const checkboxLive = document.getElementById(checkboxIdLive);
    const checkboxDownloads = document.getElementById(checkboxIdDownloads);
    const checkboxBauteile = document.getElementById(checkboxIdBauteile);

    const navbarLive = document.getElementById("LiveLi");
    const navbarDownloads = document.getElementById("DownloadsLi");
    const navbarBauteile = document.getElementById("BauteileLi");

    if (checkboxLive.checked) {
        navbarLive.style.display = "none";
        const currentData = await readJsonFromFile();
        currentData["live"] = checkboxLive.checked;
        await writeJsonToFile(currentData);
    } else {
        navbarLive.style.display = "block";
        const currentData = await readJsonFromFile();
        currentData["live"] = checkboxLive.checked;
        await writeJsonToFile(currentData);
    }
    if (checkboxDownloads.checked) {
        navbarDownloads.style.display = "none";
        const currentData = await readJsonFromFile();
        currentData["downloads"] = checkboxDownloads.checked;
        await writeJsonToFile(currentData);
    } else {
        navbarDownloads.style.display = "block";
        const currentData = await readJsonFromFile();
        currentData["downloads"] = checkboxDownloads.checked;
        await writeJsonToFile(currentData);
    }
    if (checkboxBauteile.checked) {
        navbarBauteile.style.display = "none";
        const currentData = await readJsonFromFile();
        currentData["bauteile"] = checkboxIdBauteile.checked;
        await writeJsonToFile(currentData);
    } else {
        navbarBauteile.style.display = "block";
        const currentData = await readJsonFromFile();
        currentData["bauteile"] = checkboxIdBauteile.checked;
        await writeJsonToFile(currentData);
    }
}

// Funktion, die die UI basierend auf der JSON-Datei aktualisiert
async function updateUiOnJson() {
    const data = await readJsonFromFile();
    Object.keys(data).forEach(key => {
        const checkbox = document.getElementById(key);
        checkbox.checked = data[key];
        console.log(`${key} set to ${data[key]}`);
    });
}


function easterEgg(){
    let clickCount = 0;

    // Return a function that increments the counter and checks if it reaches 2 (for double click)
    return function() {
        clickCount++;
        if (clickCount === 8) {
            window.location.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley";
            // Reset the counter after double click
            clickCount = 0;
        }
    };
}

document.body.addEventListener("dblclick", easterEgg());