<?php
require_once 'diary_Class.php';
require_once 'diary_File_System.php';
$fm = new FileManager();
$person = new Person("Rene", "Websiteguy", "12345", [new Eintrag("05.02.2024", "rene", "website weiterentwickelt")]);
echo $person->getName();
echo "<br>";
FileManager::savePerson($person);
$person2 = FileManager::readPerson("Rene");
echo $person2->getRolle();



//$person2 = FileManager::readPerson("Rene");
//echo $person2->getName();
?>