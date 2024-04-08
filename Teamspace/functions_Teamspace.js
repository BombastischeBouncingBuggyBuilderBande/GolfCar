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
