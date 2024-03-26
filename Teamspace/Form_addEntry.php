<?php
/**
 * Verarbeitet die Hinzufügung von Einträgen zu einem Teamspace-Tagebuch.
 *
 * @author: René
 */

// Einbinden externer PHP-Dateien für Datenbankzugriff und Funktionen
require 'Datenbank.php'; // Datenbankklasse
require 'Teamspace_PHPFunctions.php'; // Dateiübergreifende Funktionen

// Instanziierung der Datenbankklasse
$db = new Datenbank();

// Überprüfung, ob alle erforderlichen Formularfelder gesetzt sind
if(isset($_POST['name']) && isset($_POST['datum']) && isset($_POST['as']) && isset($_POST['beschreibung'])){
    // Zuweisung der Formulardaten zu lokalen Variablen
    $name = $_POST['name'];
    $datum = $_POST['datum'];
    $beschreibung = $_POST['beschreibung'];
    $as = $_POST['as'];

    // Hinzufügen des Eintrags zur Datenbank über eine Methode der Datenbankklasse
    $db->addEintrag($name, $beschreibung, $as, $datum);

    // Erstellung der Teamspace-Tabelle und Informationsbox, Rückgabe als JSON-Antwort
    echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $name, 1), $name))); // Funktionen aus Teamspace_PHPFunctions.php

} else {
    // Erstellung eines Strings zur Fehlerdiagnose, welche Felder gesetzt sind
    $resultString = "name: ".isset($_POST['name'])."   datum: ".isset($_POST['datum'])."   as: ".isset($_POST['as'])."   beschreibung:".isset($_POST['beschreibung']);
    // Rückgabe eines Fehlerstatus und des Diagnosestrings als JSON-Antwort
    echo json_encode(array('success' => 0, 'entries' => $resultString));
}
?>
