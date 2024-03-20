<?php
require 'Datenbank.php'; // Datenbankklasse
require 'Teamspace_PHPFunctions.php'; // Dateiübergreifende Funktionen

$db = new Datenbank();

// Überprüfen, ob die Anmeldedaten gesendet wurden
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Nutzerdaten überprüfen
    $user = $db->getPersonByName($username);
    if($user && $user['passwort'] === $password){
        // Passwort überprüfen (Hier sollte ein sicheres Verfahren wie password_hash und password_verify verwenden)
        echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $username, 1), $username))); // Functions of Teamspace_PHPFunctions.php
    } else {
        echo json_encode(array('success' => 0));
    }
} else {
    echo json_encode(array('success' => 0));
}
?>
