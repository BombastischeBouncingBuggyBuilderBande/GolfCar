<?php

require_once 'diary_Class.php';
require_once 'diary_FileManager.php';

$person = new Person("Rene", "Websiteguy");
echo $person->getName();
FileManager::savePerson($person);

//$person2 = FileManager::readPerson("Rene");
//echo $person2->getName();
?>