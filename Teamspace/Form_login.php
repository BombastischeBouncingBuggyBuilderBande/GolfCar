<?php
/**
 * Verarbeitet die Anmeldung eines Nutzers im Teamspace-Tagebuch.
 * Überprüft die Anmeldedaten gegen die in der Datenbank gespeicherten Informationen.
 *
 * Wichtig: Dieses Skript verwendet eine einfache Passwortüberprüfung.
 * In einer Produktionsumgebung sollte stattdessen eine sichere Methode wie
 * password_hash() und password_verify() verwendet werden.
 *
 * @author René
 */

require 'Datenbank.php'; // Bindet die Datenbankklasse ein.
require 'Teamspace_PHPFunctions.php'; // Bindet dateiübergreifende Funktionen ein.
$db = new Datenbank();
// Überprüft, ob die Anmeldedaten gesendet wurden.
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Überprüft die Nutzerdaten.
    $user = $db->getPersonByName($username);
    if($user && $user['passwort'] === $password){
        // An dieser Stelle sollte ein sichereres Verfahren zur Passwortüberprüfung eingesetzt werden.
        // Bei Erfolg wird ein JSON-Objekt mit Erfolgsmeldung und Benutzerdaten zurückgegeben.
        echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $username, 1), $username)));
    } else {
        // Bei Misserfolg wird ein JSON-Objekt mit einer Misserfolgsmeldung zurückgegeben.
        echo json_encode(array('success' => 0));
    }
} else {
    // Falls nicht alle Anmeldedaten gesendet wurden, erfolgt eine Fehlermeldung.
    echo json_encode(array('success' => 0));
}
?>