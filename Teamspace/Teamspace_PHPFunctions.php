<?php
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
function createTeamspaceTable($db, $username, $page){
    if($username != "admin") {
        $entries = $db->getEintraegeByPerson($username);
    }else{
        // get all Entries
        return 0;
    }
    $entriesHtml = createTeamspacePartTable($entries, $page, 10);

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

function createTeamspacePartTable($entries, $page, $shownPerPage){
    $count = 0;
    $entriesHtml = "<table><tr><th>Beschreibung</th><th>Arbeitsstunden</th><th>Datum</th></tr>";
    foreach($entries as $entry){
        $as = $entry['arbeitsstunden'];
        $beschreibung = $entry['beschreibung'];
        $datum = $entry['Datum'];
        $eintragID = $entry['EintragID'];

        if(($page*$shownPerPage)-$shownPerPage <= $count && $page*$shownPerPage > $count) {
            $entriesHtml .= "<tr>
                <td>".$beschreibung."</td>
                <td>".$as."</td>
                <td>".$datum."</td>
                <td>
                <form class='deleteForm'>
                    <input style='display: none' name='EintragID' type='text' value='".$eintragID."'>
                    <button class='deletebutton' type='submit'>-</button>
                </form>
                </td>
                <td>
                    <button id='editbutton' onclick='openEditEntry(".$eintragID.",".$as.",".$beschreibung.",".$datum.")'>edit</button>
                    <script>
                        function openEditEntry(id, as, beschreibung, datum){
                            document.getElementById('Teamspace_Base_View').style.display = 'none';
                            document.getElementById('Teamspace_editEntry').style.display = 'block';
                            document.getElementById('EintragID').innerHTML = id;
                            document.getElementById('editEntryBeschreibung').innerHTML = beschreibung;
                            document.getElementById('editEntryAs').innerHTML = as;
                            document.getElementById('editEntryDatum').innerHTML = datum;


                            return true;
                        }     
                    </script>
                </td>
                </tr>";
            $count += 1;
        }
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
                <form id='Teamspace_editEntry'>
                    <input name='ID' id='eintragID' type='text' style='display: none;'>
                    <input name='name' value='$username' style='display: none;'>
                    <input class='input-modern' id='editEntryDate' name='datum' type='date'>
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
        $('#Teamspace_editEntry').on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: 'POST',
                url: 'Teamspace/Form_editEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
                data: $(this).serialize(),
                success: function(response){
                    // Die Antwort des Servers verarbeiten
                    console.log(response);
            
                    var jsonData = JSON.parse(response);
            
                    if (jsonData.success === 1) {
                        $('#entries').html(jsonData.entries);
                        closeEditEntry();
                    } else {
                        alert('Fehler im AddEntry Form');
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
                    console.log(response);
            
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
                    console.log(response);
            
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
