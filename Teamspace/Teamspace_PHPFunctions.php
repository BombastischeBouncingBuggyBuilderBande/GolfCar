<?php
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
function createTeamspaceTable($db, $username, $page){
    $entries = $db->getEintraegeByPerson($username);
    $entriesHtml = "<script src='Teamspace/functions_Teamspace.js'></script>";

    if($username !== "admin") {
        $entriesHtml .= createTeamspacePartTable($entries, $page, 5);
    }else{
        $entriesHtml .= createTeamspacePartTable($entries, $page, 5, $username);
    }
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
            ";
}
?>
