<?php
require 'Datenbank.php'; // Datenbankklasse
require 'Teamspace_PHPFunctions.php'; // Dateiübergreifende Funktionen

$db = new Datenbank();
if(isset($_POST['EintragID'])){
    $username = ($db->getEintragByID($_POST['EintragID']))['Name'];
    $db->deleteEintrag($_POST['EintragID']);
        echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $username, 1), $username))); // Functions of Teamspace_PHPFunctions.php

} else {
    echo json_encode(array('success' => 0));
}
?>

