<?php
/**
 * Verarbeitet die Anmeldung eines Nutzers im Teamspace-Tagebuch.
 * Überprüft die Anmeldedaten gegen die in der Datenbank gespeicherten Informationen.
 *
 * Verwendet jetzt eine sichere Methode zur Passwortüberprüfung mitte<<ls
 * password_hash() und password_verify().
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
    if($user && password_verify($password, $user['passwort'])){
        // Das Passwort ist korrekt. Nutzer wird angemeldet.
        // Erzeugt ein JSON-Objekt mit Erfolgsmeldung und Benutzerdaten.
        echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $username, 1), $username)));
    } else {
        // Das Passwort ist inkorrekt. Anmeldung fehlgeschlagen.
        echo json_encode(array('success' => 0, 'entries' => $user['passwort']));
    }
} else {
    // Falls nicht alle Anmeldedaten gesendet wurden, erfolgt eine Fehlermeldung.
    echo json_encode(array('success' => 0));
}
?>
