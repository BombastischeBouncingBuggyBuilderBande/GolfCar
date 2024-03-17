<?php
require 'Datenbank.php'; // Datenbankklasse
require 'diary_PHPFunctions.php'; // Dateiübergreifende Funktionen

$db = new Datenbank();
if(isset($_POST['name']) && isset($_POST['datum']) && isset($_POST['as']) && isset($_POST['beschreibung'])){
    $name = $_POST['name'];
    $datum = $_POST['datum'];
    $beschreibung = $_POST['beschreibung'];
    $as = $_POST['as'];

    $db->addEintrag($name, $beschreibung, $as, $datum);

    echo json_encode(array('success' => 1, 'entries' => createInformationBox(createDiaryTable($db, $name, 1), $name))); // Functions of diary_PHPFunctions.php

} else {
    $resultString = "name: ".isset($_POST['name'])."   datum: ".isset($_POST['datum'])."   as: ".isset($_POST['as'])."   beschreibung:".isset($_POST['beschreibung']);
    echo json_encode(array('success' => 0, 'entries' => $resultString));
}
?>

