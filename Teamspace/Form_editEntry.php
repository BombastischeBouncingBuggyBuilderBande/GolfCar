<?php
/**
 * Bearbeitet (aktualisiert) einen bestehenden Eintrag im Teamspace-Tagebuch durch Löschen und Neuhinzufügen.
 *
 * @author René
 */

require 'Datenbank.php'; // Bindet die Datenbankklasse ein.
require 'Teamspace_PHPFunctions.php'; // Bindet dateiübergreifende Funktionen ein.

$db = new Datenbank();

// Überprüft, ob alle notwendigen Daten über POST gesendet wurden.
if(isset($_POST['name']) && isset($_POST['datum']) && isset($_POST['as']) && isset($_POST['beschreibung']) && isset($_POST['ID'])){
    // Speichert die übergebenen Daten in Variablen.
    $name = $_POST['name'];
    $datum = $_POST['datum'];
    $beschreibung = $_POST['beschreibung'];
    $as = $_POST['as'];
    $id = $_POST['ID'];

    // Löscht den Eintrag mit der gegebenen ID.
    $db->deleteEintrag($id);
    // Fügt einen neuen Eintrag mit den aktualisierten Daten hinzu.
    $db->addEintrag($name, $beschreibung, $as, $datum);

    // Gibt ein JSON-Objekt zurück, das den Erfolg der Operation anzeigt und die aktualisierte Eintragsansicht enthält.
    echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $name, 1), $name)));
} else {
    // Gibt Fehlerinformationen zurück, falls nicht alle Daten übermittelt wurden.
    $resultString = "name: " . isset($_POST['name']) . " datum: " . isset($_POST['datum']) . " as: " . isset($_POST['as']) . " beschreibung:" . isset($_POST['beschreibung']);
    echo json_encode(array('success' => 0, 'entries' => $resultString));
}
?>
