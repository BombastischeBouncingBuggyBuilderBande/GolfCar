<?php
require 'Datenbank.php'; // Datenbankklasse
require 'Teamspace_PHPFunctions.php'; // Dateiübergreifende Funktionen

$db = new Datenbank();
if(isset($_POST['name']) && isset($_POST['datum']) && isset($_POST['as']) && isset($_POST['beschreibung']) && isset($_POST['ID'])){
    $name = $_POST['name'];
    $datum = $_POST['datum'];
    $beschreibung = $_POST['beschreibung'];
    $as = $_POST['as'];
    $id = $_POST['ID'];

    $db->deleteEintrag($id);
    $db->addEintrag($name, $beschreibung, $as, $datum);

    echo json_encode(array('success' => 1, 'entries' => createInformationBox(createTeamspaceTable($db, $name, 1), $name))); // Functions of Teamspace_PHPFunctions.php

} else {
    $resultString = "name: ".$_POST['name']."   datum: ".$_POST['datum']."   as: ".$_POST['as']."   beschreibung:".$_POST['beschreibung'];
    echo json_encode(array('success' => 0, 'entries' => $resultString));
}
?>