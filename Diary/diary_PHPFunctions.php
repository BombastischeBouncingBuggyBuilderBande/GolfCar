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
    $entriesHtml = "<table><tr><th>Beschreibung</th><th>Datum</th></tr>";
    foreach($entries as $entry){
        if(($page*$shownPerPage)-$shownPerPage <= $count && $page*$shownPerPage > $count) {
            $entriesHtml .= "<tr>
                <td>".$entry['beschreibung']."</td>
                <td>".$entry['Datum']."</td>
                <td>".$entry['Name']."</td>

                <td>
                <form class='deleteForm'>
                <input style='display: none' name='EintragID' type='text' value='".$entry['EintragID']."'>
                <button type='submit'>-</button>
                </form>
                </td>
                </tr>";
            $count += 1;
        }
    }
    return $entriesHtml;
}

function createInformationBox($table, $functions = ""){
    return "
            <div>
                <div id='Diary_Table'>
                    $table
                </div>
                <div id='Diary_Functions'>
                    $functions
                </div>
            </div>";
}
?>
