<?php
require_once 'Classes/Datenbank.php';
require_once 'Classes/Person.php';
require_once 'Classes/Eintrag.php';

error_reporting(E_ALL);
ini_set ('display_errors', 'On');

echo "Begin DiaryTesting<br>";

$db = new Datenbank();

// Person erstellen
$personName = "Julia Müller";
$rolle = "Redakteurin";
$passwort = "sehrSicheresPasswort456"; // später Hashing hinzufügen

// Prüfen, ob die Person bereits existiert, und wenn nicht, hinzufügen
$result = $db->addPerson_ifNotExist($personName, $rolle, $passwort);
if($result){
    echo "klasse Erstellt <br>";
}else{
    echo "Person existiert bereits <br>";
}

foreach($db->getPersonByName("Julia Müller") as $e){
    echo $e."<br>";
};

// Einen neuen Tagebucheintrag hinzufügen
$beschreibung = "Heute habe ich an dem Projekt 'Tagebuch' gearbeitet.";
$arbeitsstunden = 8;
$datum = "2024-03-14"; // YYYY-MM-DD
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);

echo "Ein neuer Tagebucheintrag für $personName wurde hinzugefügt.<br>";

echo "Tagebucheinträge von $personName:<br>";
Eintrag::zeigeEintraege($personName);