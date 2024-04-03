<?php
/**
 * PHP-Skript zur Handhabung von Tagebucheinträgen in einem Teamspace.
 * Stellt Funktionen zum Erstellen von Tabellenansichten und Verwaltungsoptionen bereit.
 *
 * @author René
 */

// Fehlerberichterstattung aktivieren für Entwicklungsphase
error_reporting(E_ALL);
ini_set('display_errors', 'On');

/**
 * Erstellt die HTML-Struktur für die Teamspace-Tabelle basierend auf Benutzername und Seite.
 * Unterscheidet zwischen Admin- und Nutzeransicht.
 *
 * @param PDO $db Datenbankverbindung.
 * @param string $username Benutzername des aktuellen Nutzers.
 * @param int $page Aktuelle Seite der Tabelle.
 * @return string HTML-Struktur der Tabelle.
 */
function createTeamspaceTable($db, $username, $page){
    // Holen der Einträge für den spezifischen Nutzer aus der Datenbank
    $entries = $db->getEintraegeByPerson($username);
    // Initialisierung des HTML-Strings mit einem JS-Skript-Tag
    $entriesHtml = "<script src='Teamspace/functions_Teamspace.js'></script>";

    // Unterscheidung zwischen Admin und regulären Nutzern für die Tabellenansicht
    if($username !== "admin") {
        // Für reguläre Nutzer
        $entriesHtml .= createTeamspacePartTable($entries, $page, 5);
    } else {
        // Für Admin mit zusätzlichem Parameter für Username
        $entriesHtml .= createTeamspacePartTable($entries, $page, 5, $username);
    }
    return $entriesHtml;
}

/**
 * Erstellt einen Teil der Teamspace-Tabelle basierend auf der aktuellen Seite und Anzahl der Einträge pro Seite.
 * Optional wird der Benutzername mit einbezogen, falls es sich um die Admin-Sicht handelt.
 *
 * @param array $entries Array von Tagebucheinträgen.
 * @param int $page Aktuelle Seite.
 * @param int $shownPerPage Anzahl der Einträge pro Seite.
 * @param string|false $username Benutzername, falls vorhanden, sonst false.
 * @return string Teil der HTML-Struktur der Tabelle.
 */
function createTeamspacePartTable($entries, $page, $shownPerPage, $username = false){
    // Berechnung von Start- und Endindex für die Einträge der aktuellen Seite
    $start = ($page - 1) * $shownPerPage;
    $end = $start + $shownPerPage;
    // Initialisierung des Zählers
    $count = 0;
    $entry_in_Table_count = 0;


    // Wenn Seite leer, dann soll die vorherige angezeigt werden
    if($count >= $end){
        $page -= 1;
        $start = ($page - 1) * $shownPerPage;
    }   $end = $start + $shownPerPage;

    // Aufbau des Tabellenkopfes abhängig von der Sicht (Admin/Nutzer)
    if($username !== false){
        $entriesHtml = "<table class='Diarytable'><tr><th>User</th><th>Beschreibung</th><th>Arbeitsstunden</th><th>Datum</th></tr>";
    } else {
        $entriesHtml = "<table class='Diarytable'><tr><th>Beschreibung</th><th>Arbeitsstunden</th><th>Datum</th></tr>";
    }

    // Durchlaufen der Einträge und Hinzufügen zur Tabelle
    foreach($entries as $entry){
        if($count >= $start && $count < $end) {
            $entry_in_Table_count += 1;
            // Extrahieren der Eintragsdaten
            $as = $entry['arbeitsstunden'];
            $beschreibung = $entry['beschreibung'];
            $datum = $entry['Datum'];
            $eintragID = $entry['EintragID'];
            // Parameter für das Bearbeiten eines Eintrags
            $parameters = $eintragID.','.$as.',"'.$beschreibung.'","'.$datum.'"';

            // Aufbau der Tabellenzeile
            if($username !== false){
                $entriesHtml .= "<tr><td>".$entry['Name']."</td>";
            } else {
                $entriesHtml .= "<tr>";
            }
            $entriesHtml .= "
                <td class='leftText'>".$beschreibung."</td>
                <td>".$as."</td>
                <td>".$datum."</td>
                <td>
                <form class='deleteForm'>
                    <input style='display: none' name='currentPage' value='".$page."'>
                    <input style='display: none' name='EintragID' type='text' value='".$eintragID."'>
                    <button class='deletebutton' type='submit'>-</button>
                </form>
                </td>
                <td>
                    <button id='editbutton' onclick='openEditEntry(".$parameters.")'>edit</button>
                </td>
                </tr>";
        }
        if($count >= $end) break; // Beenden, wenn das Ende der Seite erreicht ist
        $count++;
    }
    $entriesHtml .= "</table>";
    if($entry_in_Table_count > 0) {
        return $entriesHtml;
    }else {
        return "page empty";
    }
}

/**
 * Erstellt eine Informationsbox, die verschiedene Funktionen und die Teamspace-Tabelle beinhaltet.
 *
 * @param string $table HTML-Struktur der Teamspace-Tabelle.
 * @param string $username Benutzername des aktuellen Nutzers.
 * @param int $page Aktuelle Seite (Standardwert = 1).
 * @return string HTML-Struktur der Informationsbox.
 */
function createInformationBox($table, $username, $page = 1){
    return "
            <link rel='stylesheet' href='Teamspace/style_Teamspace.css'>
            <div id='Teamspace_Base_View'> <!-- Grundansicht des Teamspace -->
                <div id='Teamspace_Table'>
                    $table
                </div>
                <div id='Teamspace_Functions'>
                    <div id='nextprePage'>
                        <!-- Navigation zur vorherigen und nächsten Seite -->
                        <form id='Teamspace_PrevPage'><input style='display: none' name='username' value='$username' type='text'><input style='display: none' name='CurrentPage' value='$page' type='text'><button class='TeamspacenextprePage' type='submit'><</button></form>
                        <a id='Teamspace-page'>".$page."</a>
                        <form id='Teamspace_NextPage'><input style='display: none' name='username' value='$username' type='text'><input style='display: none' name='CurrentPage' value='$page' type='text'><button class='TeamspacenextprePage' type='submit'>></button></form>
                    </div>
                        <button id='Teamspace-openaddentry' onclick='openAddEntry()'>Add Entry</button>
                </div>
            </div>
            <div id='Teamspace_Entry_View' style='display: none'> <!-- Ansicht zum Hinzufügen eines Eintrags -->
                <button onclick='closeAddEntry()'>back</button>
                <form id='Teamspace_addEntry'>
                    <input style='display: none;' name='currentPage' value='$page'>
                    <input name='name' value='$username' style='display: none;'>
                    <input class='input-modern' id='addEntryDate' name='datum' type='date'>
                    <input class='input-modern' id='addEntryAs' placeholder='Arbeitsstunden' name='as' min='0' type='number' step='0.1'>
                    <textarea class='input-modern' id='button-input-modern' placeholder='Beschreibung' name='beschreibung'></textarea>
                    <button type='submit'>add Entry</button>
                </form>
            </div>
            <div id='Teamspace_editEntry' style='display: none'> <!-- Add Entry View -->
                <button onclick='closeEditEntry()'>back</button>
                <form id='Teamspace_editEntryForm'>
                    <input style='display: none;' name='currentPage' value='$page'>
                    <input name='ID' id='editEintragID' type='text' style='display: none;'>
                    <input name='name' value='$username' style='display: none;'>
                    <input class='input-modern' id='editEntryDatum' name='datum' type='date'>
                    <input class='input-modern' id='editEntryAs' placeholder='Arbeitsstunden' name='as' min='0' type='number' step='0.1'>
                    <textarea class='input-modern' id='editEntryBeschreibung' placeholder='Beschreibung' name='beschreibung'></textarea>
                    <button type='submit'>Save Entry</button>
                </form>
            </div>
            ";
}
?>
