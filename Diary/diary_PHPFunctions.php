<?php
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
function createDiaryTable($db, $username, $page){
    if($username != "admin") {
        $entries = $db->getEintraegeByPerson($username);
    }else{
        // get all Entries
        return 0;
    }
    $entriesHtml = createDiaryPartTable($entries, $page, 10);
    // Adding button for Diary Pages

    $entriesHtml.= "
        <script>
    $(document).ready(function(){
        $('.deleteForm').on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: 'POST',
                url: 'Diary/Form_deleteEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
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

function createDiaryPartTable($entries, $page, $shownPerPage){
    $count = 0;
    $entriesHtml = "<table><tr><th>Beschreibung</th><th>Arbeitsstunden</th><th>Datum</th></tr>";
    foreach($entries as $entry){
        if(($page*$shownPerPage)-$shownPerPage <= $count && $page*$shownPerPage > $count) {
            $entriesHtml .= "<tr>
                <td>".$entry['beschreibung']."</td>
                <td>".$entry['arbeitsstunden']."</td>
                <td>".$entry['Datum']."</td>
                <td>
                <form class='deleteForm'>
                <input style='display: none' name='EintragID' type='text' value='".$entry['EintragID']."'>
                <button class='deletebutton' type='submit'>-</button>
                </form>
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
            <link rel='stylesheet' href='Diary/style_diary.css'>
            <div id='Diary_Base_View'> <!-- Diary Base View -->
                <div id='Diary_Table'>
                    $table
                </div>
                <div id='Diary_Functions'>
                    <div id='nextprePage'>
                        <form id='Diary_PrevPage'><input style='display: none' name='username' value='$username' type='text'><input style='display: none' name='CurrentPage' value='$page' type='text'><button class='DiarynextprePage' type='submit'><</button></form>
                        <form id='Diary_NextPage'><input style='display: none' name='username' value='$username' type='text'><input style='display: none' name='CurrentPage' value='$page' type='text'><button class='DiarynextprePage' type='submit'>></button></form>
                    </div>

                        <button onclick='openAddEntry()'>Add Entry</button>
                        <script>
                            function openAddEntry(){
                                document.getElementById('Diary_Base_View').style.display = 'none';
                                document.getElementById('Diary_Entry_View').style.display = 'block';
                            }      
                            function closeAddEntry(){
                                document.getElementById('Diary_Base_View').style.display = 'block';
                                document.getElementById('Diary_Entry_View').style.display = 'none';
                            }                                          
                        </script>
                </div>
            </div>
            <div id='Diary_Entry_View' style='display: none'> <!-- Add Entry View -->
                <button onclick='closeAddEntry()'>back</button>
                <form id='Diary_addEntry'>
                    <input name='name' value='$username' style='display: none;'>
                    <input class='input-modern' id='addEntryDate' name='datum' type='date'>
                    <input class='input-modern' id='addEntryAs' placeholder='Arbeitsstunden' name='as' type='number'>
                    <textarea class='input-modern' id='button-input-modern' placeholder='Beschreibung' name='beschreibung'></textarea>
                    <button type='submit'>add Entry</button>
                </form>
            </div>
            <script>
    $(document).ready(function(){
        $('#Diary_addEntry').on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: 'POST',
                url: 'Diary/Form_addEntry.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
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
        $('#Diary_PrevPage').on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: 'POST',
                url: 'Diary/Form_PrevPage.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
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
        $('#Diary_NextPage').on('submit', function(e){
            e.preventDefault(); // Verhindert das Neuladen der Seite
            $.ajax({
                type: 'POST',
                url: 'Diary/Form_NextPage.php', // Der Pfad zum PHP-Skript, das die Anmeldung verarbeitet
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
