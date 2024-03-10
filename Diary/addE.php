<?php
require "diary_Classes.php";
/*
echo FileManager::readPerson("rene")->getRolle();
$rene = FileManager::readPerson("rene");
$rene->addEintrag("03.03.2024", "added");
*/
$rene = new Person("rene", "Website-Guy", "pass"/*, [new Eintrag("02.12.2023", "rene", "deleted"), new Eintrag("03.12.2023", "rene",  "added")]*/);
$rene->addEintrag("20.10.2024", "hallo");
FileManager::savePerson($rene);
/*
FileManager::readPerson("rene")->addEintrag("2024-02-20", "rene", "Added Website");
FileManager::readPerson("rene")->addEintrag("2024-02-21", "rene", "Deleted Website");
FileManager::readPerson("rene")->addEintrag("2024-02-22", "rene", "Added Website");
FileManager::readPerson("rene")->addEintrag("2024-02-24", "rene", "Deleted Website");
*/