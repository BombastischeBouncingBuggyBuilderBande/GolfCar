<?php
require 'Datenbank.php'; // Pfad zur Datenbankklasse anpassen

$db = new Datenbank();

// Überprüfen, ob die Anmeldedaten gesendet wurden
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Nutzerdaten überprüfen
    $user = $db->getPersonByName($username);

    if($user && $user['passwort'] === $password){
        // Passwort überprüfen (Hier sollten Sie ein sicheres Verfahren wie password_hash und password_verify verwenden)
        $entries = $db->getEintraegeByPerson($username);
        $entriesHtml = "";
        foreach($entries as $entry){
            $entriesHtml .= "<p>".$entry['beschreibung']."</p>"; // Beispiel, wie Einträge angezeigt werden könnten
        }

        echo json_encode(array('success' => 1, 'entries' => $entriesHtml));
    } else {
        echo json_encode(array('success' => 0));
    }
} else {
    echo json_encode(array('success' => 0));
}
?>

