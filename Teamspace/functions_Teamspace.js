//---------------------------- Control -------------------------------------------------------------------------------
function change_control_info(page){
    document.getElementById("Teamspace-ControlPage-"+page).style.display = "block";
    document.getElementById("control-BottomButton-"+page).classList.add('underlined');
    if(page !== 1){
        document.getElementById("Teamspace-ControlPage-1").style.display = "none";
        document.getElementById("control-BottomButton-1").classList.remove('underlined');
    }
    if(page !== 2){
        document.getElementById("Teamspace-ControlPage-2").style.display = "none";
        document.getElementById("control-BottomButton-2").classList.remove('underlined');
    }
}


//---------------------------- Diary ---------------------------------------------------------------------------------
function openAddEntry(){
    document.getElementById('Teamspace_Base_View').style.display = 'none';
    document.getElementById('Teamspace_Entry_View').style.display = 'block';
}
function openEditEntry(id, as, beschreibung, datum){
    document.getElementById('Teamspace_Base_View').style.display = 'none';
    document.getElementById('Teamspace_editEntry').style.display = 'block';
    document.getElementById('editEintragID').value = id;
    document.getElementById('editEntryBeschreibung').value = beschreibung;
    document.getElementById('editEntryAs').value = as;
    document.getElementById('editEntryDatum').value = datum;
    return true;
}
function closeAddEntry(){
    document.getElementById('Teamspace_Base_View').style.display = 'block';
    document.getElementById('Teamspace_Entry_View').style.display = 'none';
}
function closeEditEntry(){
    document.getElementById('Teamspace_Base_View').style.display = 'block';
    document.getElementById('Teamspace_editEntry').style.display = 'none';
}

// Multiple "on Submit" functions to react to certain buttons
$(document).ready(function(){
    $('#Teamspace_addEntry').on('submit', function(e){
        e.preventDefault(); // Verhindert das Neuladen der Seite
        $.ajax({
            type: 'POST',
            url: 'Teamspace/Form_addEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
            data: $(this).serialize(),
            success: function(response){
                // Die Antwort des Servers verarbeiten
                console.log(response);

                var jsonData = JSON.parse(response);

                if (jsonData.success === 1) {
                    $('#entries').html(jsonData.entries);
                    closeAddEntry();
                } else {
                    alert('Fehler im AddEntry Form');
                }
            }
        });
    });
});
$(document).ready(function(){
    $('#Teamspace_editEntryForm').on('submit', function(e){
        e.preventDefault(); // Verhindert das Neuladen der Seite
        $.ajax({
            type: 'POST',
            url: 'Teamspace/Form_editEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
            data: $(this).serialize(),
            success: function(response){
                // Die Antwort des Servers verarbeiten

                var jsonData = JSON.parse(response);

                if (jsonData.success === 1) {
                    $('#entries').html(jsonData.entries);
                    closeEditEntry();
                } else {
                    alert('Fehler im editEntry Form');
                }
            }
        });
    });
});
$(document).ready(function(){
    $('#Teamspace_PrevPage').on('submit', function(e){
        e.preventDefault(); // Verhindert das Neuladen der Seite
        $.ajax({
            type: 'POST',
            url: 'Teamspace/Form_PrevPage.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
            data: $(this).serialize(),
            success: function(response){
                // Die Antwort des Servers verarbeiten

                var jsonData = JSON.parse(response);

                if (jsonData.success === 1) {
                    $('#entries').html(jsonData.entries);
                    closeAddEntry();
                } else {
                    alert('Fehler im PrevPage Form');
                }
            }
        });
    });
});
$(document).ready(function(){
    $('#Teamspace_NextPage').on('submit', function(e){
        e.preventDefault(); // Verhindert das Neuladen der Seite
        $.ajax({
            type: 'POST',
            url: 'Teamspace/Form_NextPage.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
            data: $(this).serialize(),
            success: function(response){
                // Die Antwort des Servers verarbeiten

                var jsonData = JSON.parse(response);

                if (jsonData.success === 1) {
                    $('#entries').html(jsonData.entries);
                    closeAddEntry();
                } else {
                    alert('Fehler im PrevPage Form');
                }
            }
        });
    });
});
$(document).ready(function(){
    $('.deleteForm').on('submit', function(e){
        e.preventDefault(); // Verhindert das Neuladen der Seite
        var confirmation = confirm('Sind Sie sicher, dass Sie diesen Eintrag löschen möchten?');
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: 'Teamspace/Form_deleteEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
                data: $(this).serialize(),
                success: function (response) {
                    // Die Antwort des Servers verarbeiten

                    var jsonData = JSON.parse(response);

                    if (jsonData.success === 1) {
                        $('#entries').html(jsonData.entries);
                    } else {
                        alert('Fehler im DeleteEntry Form');
                    }
                }
            });
        }
    });
});

//---------------------------- Settings ---------------------------------------------------------------------------------
async function handleCheckbox(checkbox) {
    await readJson();
    const response = await fetch('Teamspace/state.json');
    const jsonData = await response.json();

    const statesArray = jsonData.States;

    statesArray.forEach(item => {
        if (item.name === checkbox){
            if (item.state){
                item.state = false;
                console.log(item.name + " setted to " + item.state);
            } else {
                item.state = true;
                console.log(item.name + " setted to " + item.state);
            }
        }
    });

    const updatedJson = JSON.stringify(jsonData);

    const writeResponse = await fetch('Teamspace/write_to_json.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: updatedJson
    });

    if (writeResponse.ok) {
        console.log('JSON file updated successfully!');
    } else {
        console.error('Failed to update JSON file');
    }


}

//---------------------------- Live ---------------------------------------------------------------------------------

function showFallbackMessage() {
    const videoFrame = document.getElementById('videoFrame_control');
    const fallbackMessage = document.getElementById('fallbackMessage_control');
    fallbackMessage.style.display = 'flex'; // Show the fallback message
    videoFrame.style.display = 'none'; // Hide the video player
}
//---------------------------- Car ---------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function() {
// pressed Event listeners
    document.getElementById('control-btn-w').addEventListener('mousedown', () => sendCommand('press', 'W'));
    document.getElementById('control-btn-a').addEventListener('mousedown', () => sendCommand('press', 'A'));
    document.getElementById('control-btn-s').addEventListener('mousedown', () => sendCommand('press', 'S'));
    document.getElementById('control-btn-d').addEventListener('mousedown', () => sendCommand('press', 'D'));
    document.getElementById('control-btn-grab').addEventListener('mousedown', () => sendCommand('press', 'grab'));
    document.getElementById('control-btn-release').addEventListener('mousedown', () => sendCommand('press', 'release'));

    // released Event listeners
    document.getElementById('control-btn-w').addEventListener('mouseup', () => sendCommand('release', 'W'));
    document.getElementById('control-btn-a').addEventListener('mouseup', () => sendCommand('release', 'A'));
    document.getElementById('control-btn-s').addEventListener('mouseup', () => sendCommand('release', 'S'));
    document.getElementById('control-btn-d').addEventListener('mouseup', () => sendCommand('release', 'D'));
    document.getElementById('control-btn-grab').addEventListener('mouseup', () => sendCommand('release', 'grab'));
    document.getElementById('control-btn-release').addEventListener('mouseup', () => sendCommand('release', 'release'));

    const keyPressedState = {
        'KeyW': "W",
        'KeyA': "A",
        'KeyS': "S",
        'KeyD': "D",
        'KeyQ': "grab",
        'KeyE': "release"
    };
    const alreadypressed = {
        'W': false,
        'A': false,
        'S': false,
        'D': false,
        'grab': false,
        'release': false,
    };

    // Funktion, die aufgerufen wird, wenn eine relevante Taste gedrückt und dann losgelassen wird
    function handleKeyPressed(key) {
        console.log(`${key} pressed and released`);
    }

    document.addEventListener('keydown', function(event) {
        if (keyPressedState.hasOwnProperty(event.code)) {
            sendCommand("press", keyPressedState[event.code])
        }
    });

    document.addEventListener('keyup', function(event) {
        if (keyPressedState[event.code]) {
            sendCommand("release", keyPressedState[event.code])
        }
    });
    function sendCommand(status, command) {
        let TeamspaceControlPage1 = document.getElementById("Teamspace-ControlPage-1");
        let teamspacedisplay = document.getElementById("teamspace-display");
        let diarypart = document.getElementById("Diary-part");

        if(status === "press") {
            if (!alreadypressed[command]) {
                alreadypressed[command] = true;
            }
            if (alreadypressed[command]) {
                console.log("didnt activate");
                return 0;
            }
        }
        if (status === "release") {
            alreadypressed[command] = false;
        }
        if (TeamspaceControlPage1.style.display !== "none" && teamspacedisplay.style.display !== "none" && diarypart.style.display === "none") {
            console.log(`Status ${status} Command ${command} sent successfully.`);
            /*
            // Example: http://raspberrypi.local:5000/command/W
            const url = `http://raspberrypi.bombastisch:5000/${status}/${command}`;
            fetch(url).then(response => {
                if (response.ok) {
                    console.log(`Status ${status} Command ${command} sent successfully.`);
                } else {
                    console.error(`Failed to send command ${command}, status ${status}.`);
                }
            });
            */
        }
    }
});