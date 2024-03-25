<?php
require_once 'Datenbank.php';
require_once 'Person.php';
require_once 'Eintrag.php';

error_reporting(E_ALL);
ini_set ('display_errors', 'On');

echo "Begin TeamspaceTesting<br>";

$db = new Datenbank();

// Person erstellen
$personName = "Julia";
$rolle = "Redakteurin";
$passwort = "123"; // später Hashing hinzufügen


// Prüfen, ob die Person bereits existiert, und wenn nicht, hinzufügen
$result = $db->addPerson_ifNotExist($personName, $rolle, $passwort);
if($result){
    echo "klasse Erstellt <br>";
}else{
    echo "Person existiert bereits <br>";
}

//PErson ausprinten
foreach($db->getPersonByName("Julia") as $e){
    echo $e."<br>";
};

// Einen neuen Tagebucheintrag hinzufügen
$beschreibung = "Heute habe ich an dem Projekt 'Tagebuch' gearbeitet.";
$arbeitsstunden = 8;
$datum = "2024-03-14"; // YYYY-MM-DD
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);
$db->addEintrag($personName, $beschreibung, $arbeitsstunden, $datum);


echo "Ein neuer Tagebucheintrag für $personName wurde hinzugefügt.<br>";

echo "Tagebucheinträge von $personName:<br>";
/*
echo "<h2>Edit and Delete testing</h2>";
$db->editPerson("Julia Müller", "non", "password");

//Person ausprinten
foreach($db->getPersonByName("Julia Müller") as $e){
    echo $e."<br>";
};

//$db->deleteEintrag("21");

// Holt den zuletzt eingefügten Eintrag für diese Person, um die EintragID zu erhalten
$eintraege = $db->getEintraegeByPerson($personName);
$letzterEintrag = $eintraege[0];
$eintragId = $letzterEintrag['EintragID'];

// Ändere den Eintrag
$neueBeschreibung = "Geänderte Beschreibung";
$neueArbeitsstunden = 5;
$neuesDatum = "2024-03-14";

if ($db->editEintrag($eintragId, $neueArbeitsstunden, $neuesDatum, $neueBeschreibung)) {
    echo "Eintrag erfolgreich aktualisiert.\n";
} else {
    echo "Fehler beim Aktualisieren des Eintrags.\n";
}

// Den geänderten Eintrag anzeigen, um die Änderung zu verifizieren
$geaenderterEintrag = $db->getEintraegeByPerson($personName)[0];
echo "Geänderter Eintrag: \n";
print_r($geaenderterEintrag);
Eintrag::zeigeEintraege($personName);



/*
$db->editPerson("Julia Müller", "nada");
//PErson ausprinten
foreach($db->getPersonByName("Julia Müller") as $e){
    echo $e."<br>";
};
$eintrag = $db->getEintragByID("13");
print_r($eintrag);
echo "<br><br>";
echo $eintrag['Datum'];
$db->editEintrag(13, null, null, "nosaaaaaaaaaaaa");
Eintrag::zeigeEintraege($personName);


echo ($db->getEintragByID("13"))['Name'];
*/