<?php
/**
 * Verarbeitet das Löschen von Einträgen aus einem Teamspace-Tagebuch.
 *
 * @author : René
 */

require 'Datenbank.php'; // Datenbankklasse
require 'Teamspace_PHPFunctions.php'; // Dateiübergreifende Funktionen

$db = new Datenbank();

// Überprüfung, ob die Eintrags-ID gesetzt ist
if(isset($_POST['EintragID']) && isset($_POST['currentPage'])){
    // Abrufen des Benutzernamens, der zum Eintrag gehört
    $username = ($db->getEintragByID($_POST['EintragID']))['Name'];
    $currentpage = $_POST['currentPage'];

    // Löschen des Eintrags aus der Datenbank
    $db->deleteEintrag($_POST['EintragID']);

    // Erstellung der Teamspace-Tabelle und Informationsbox, Rückgabe als JSON-Antwort
    echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $username, $currentpage), $username, $currentpage)));
} else {
    // Rückgabe eines Fehlerstatus als JSON-Antwort, falls keine Eintrags-ID vorhanden ist
    echo json_encode(array('success' => 0));
}
?>
