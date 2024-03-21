<?php
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
function createTeamspaceTable($db, $username, $page){
    $entries = $db->getEintraegeByPerson($username);
    if($username !== "admin") {
        $entriesHtml = createTeamspacePartTable($entries, $page, 5);
    }else{
        $entriesHtml = createTeamspacePartTable($entries, $page, 5, $username);
    }

    // Adding button for Teamspace Pages
    $entriesHtml.= "
        <script>
    $(document).ready(function(){
        $('.deleteForm').on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: 'POST',
                url: 'Teamspace/Form_deleteEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
                data: $(this).serialize(),
                success: function(response){
                    // Die Antwort des Servers verarbeiten
            
                    var jsonData = JSON.parse(response);
            
                    if (jsonData.success === 1) {
                        $('#entries').html(jsonData.entries);
                    } else {
                        alert('Fehler im DeleteEntry Form');
                    }
                }
            });
        });
    });
        </script>";
    return $entriesHtml;
}

function createTeamspacePartTable($entries, $page, $shownPerPage, $username = false){
    $start = ($page - 1) * $shownPerPage; // Startindex für die aktuelle Seite
    $end = $start + $shownPerPage; // Endindex für die aktuelle Seite
    $count = 0; // Gesamtzähler für alle Einträge
    if($username !== false){
        $entriesHtml = "<table class='Diarytable'><tr><th>User</th><th>Beschreibung</th><th>Arbeitsstunden</th><th>Datum</th></tr>";
    }else {
        $entriesHtml = "<table class='Diarytable'><tr><th>Beschreibung</th><th>Arbeitsstunden</th><th>Datum</th></tr>";
    }

    foreach($entries as $entry){
        if($count >= $start && $count < $end) {
            // Extrahieren der Daten aus $entry
            $as = $entry['arbeitsstunden'];
            $beschreibung = $entry['beschreibung'];
            $datum = $entry['Datum'];
            $eintragID = $entry['EintragID'];
            $parameters = $eintragID.','.$as.',"'.$beschreibung.'","'.$datum.'"';

            // Hinzufügen des Eintrags zum HTML-String
            if($username !== false){
                $entriesHtml .= "<tr><td>".$entry['Name']."</td>";
            }else{
                $entriesHtml .= "<tr>";
            }
            $entriesHtml .= "
                <td class='leftText'>".$beschreibung."</td>
                <td>".$as."</td>
                <td>".$datum."</td>
                <td>
                <form class='deleteForm'>
                    <input style='display: none' name='EintragID' type='text' value='".$eintragID."'>
                    <button class='deletebutton' type='submit'>-</button>
                </form>
                </td>
                <td>
                    <button id='editbutton' onclick='openEditEntry(".$parameters.")'>edit</button>
                </td>
                </tr>";
        }
        if($count >= $end) break; // Wenn der Zähler den Endindex erreicht, die Schleife abbrechen
        $count++;
    }
    $entriesHtml.="</table>";
    return $entriesHtml;
}


function createInformationBox($table, $username, $page = 1){
    return "
            <link rel='stylesheet' href='Teamspace/style_Teamspace.css'>
            <div id='Teamspace_Base_View'> <!-- Teamspace Base View -->
                <div id='Teamspace_Table'>
                    $table
                </div>
                <div id='Teamspace_Functions'>
                    <div id='nextprePage'>
                        <form id='Teamspace_PrevPage'><input style='display: none' name='username' value='$username' type='text'><input style='display: none' name='CurrentPage' value='$page' type='text'><button class='TeamspacenextprePage' type='submit'><</button></form>
                        <a>".$page."</a>
                        <form id='Teamspace_NextPage'><input style='display: none' name='username' value='$username' type='text'><input style='display: none' name='CurrentPage' value='$page' type='text'><button class='TeamspacenextprePage' type='submit'>></button></form>
                    </div>
                        <button onclick='openAddEntry()'>Add Entry</button>
                        <script>
                            function openAddEntry(){
                                document.getElementById('Teamspace_Base_View').style.display = 'none';
                                document.getElementById('Teamspace_Entry_View').style.display = 'block';
                            }      
                            function closeAddEntry(){
                                document.getElementById('Teamspace_Base_View').style.display = 'block';
                                document.getElementById('Teamspace_Entry_View').style.display = 'none';
                            }
                            function closeEditEntry(){
                            document.getElementById('Teamspace_Base_View').style.display = 'block';
                            document.getElementById('Teamspace_editEntry').style.display = 'none';
                        }   
                        </script>
                </div>
            </div>
            <div id='Teamspace_Entry_View' style='display: none'> <!-- Add Entry View -->
                <button onclick='closeAddEntry()'>back</button>
                <form id='Teamspace_addEntry'>
                    <input name='name' value='$username' style='display: none;'>
                    <input class='input-modern' id='addEntryDate' name='datum' type='date'>
                    <input class='input-modern' id='addEntryAs' placeholder='Arbeitsstunden' name='as' type='number'>
                    <textarea class='input-modern' id='button-input-modern' placeholder='Beschreibung' name='beschreibung'></textarea>
                    <button type='submit'>add Entry</button>
                </form>
            </div>
            <div id='Teamspace_editEntry' style='display: none'> <!-- Add Entry View -->
                <button onclick='closeEditEntry()'>back</button>
                <form id='Teamspace_editEntryForm'>
                    <input name='ID' id='editEintragID' type='text' style='display: none;'>
                    <input name='name' value='$username' style='display: none;'>
                    <input class='input-modern' id='editEntryDatum' name='datum' type='date'>
                    <input class='input-modern' id='editEntryAs' placeholder='Arbeitsstunden' name='as' type='number'>
                    <textarea class='input-modern' id='editEntryBeschreibung' placeholder='Beschreibung' name='beschreibung'></textarea>
                    <button type='submit'>Save Entry</button>
                </form>
            </div>
            <script>
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
        </script>
            ";
}
?>
