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
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit(0);
}

header("Access-Control-Allow-Origin: " . (isset($_SERVER['HTTPS']) ? "https" : "http") . "://golfcar.space");
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
        // Bei Erfolg wird ein JSON-Objekt mit Erfolgsmeldung und Benutzerdaten zurückgegeben.
        echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $username, 1), $username)));
    } else {
        // Bei Misserfolg wird ein JSON-Objekt mit einer Misserfolgsmeldung zurückgegeben.
        echo json_encode(array('success' => 0, 'entries'=> $user['passwort']));
    }
} else {
    // Falls nicht alle Anmeldedaten gesendet wurden, erfolgt eine Fehlermeldung.
    echo json_encode(array('success' => 0));
}
?>