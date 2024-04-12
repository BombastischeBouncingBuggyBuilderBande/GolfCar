//updateUiOnJson();

//------------------------------ Checkbox -------------------------------------------------------------------------\
// Simulierte Funktion zum Lesen der JSON-Datei
const stateLink = "state.json";

async function readJsonFromFile() {
    const response = await fetch(stateLink);
    return await response.json();
}

// Simulierte Funktion zum Schreiben in die JSON-Datei
async function writeJsonToFile(data) {
    const response = await fetch(stateLink, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const responseBody = await response.text(); // oder response.json(), falls erwartet
    if (!response.ok) {
        console.error('Fehler beim Speichern der Daten:', response.status, responseBody);
    } else {
        console.log('Erfolgreich gespeichert:', responseBody);
    }
}

// Funktion, die auf Änderungen der Checkbox reagiert
async function updateUiOnChecked(checkboxIdLive = "Checkboxlive", checkboxIdDownloads = "Checkboxdownloads", checkboxIdBauteile = "Checkboxbauteile") {
    const checkboxLive = document.getElementById(checkboxIdLive);
    const checkboxDownloads = document.getElementById(checkboxIdDownloads);
    const checkboxBauteile = document.getElementById(checkboxIdBauteile);

    const navbarLive = document.getElementById("LiveLi");
    const navbarDownloads = document.getElementById("DownloadsLi");
    const navbarBauteile = document.getElementById("BauteileLi");

    if (!checkboxLive.checked) {
        navbarLive.style.display = "none";
        const currentData = await readJsonFromFile();
        console.log(currentData);

        currentData["live"] = checkboxLive.checked;
        console.log(currentData);

        await writeJsonToFile(currentData);
    } else {
        navbarLive.style.display = "block";
        const currentData = await readJsonFromFile();
        console.log(currentData);


        currentData["live"] = checkboxLive.checked;
        console.log(currentData);

        await writeJsonToFile(currentData);
    }
    if (!checkboxDownloads.checked) {
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
    if (!checkboxBauteile.checked) {
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
        console.log("Checkbox"+key);
        const checkbox = document.getElementById("Checkbox"+key);
        checkbox.checked = data[key];
        console.log(`${key} set to ${data[key]}`);
    });
}

// Start load
updateUiOnJson();