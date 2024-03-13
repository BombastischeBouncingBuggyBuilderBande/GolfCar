<?php
class Person {
    public $name;
    public $rolle;
    public $passwort;

    public function __construct($name, $rolle, $passwort) {
        $this->name = $name;
        $this->rolle = $rolle;
        $this->passwort = $passwort;
    }

    // Aktualisiert die Informationen einer Person
    public function updatePerson($name, $rolle, $passwort) {
        $db = new Datenbank();
        $db->updatePerson($this->name, $name, $rolle, $passwort);
    }

    // Lädt eine Person aus der Datenbank
    public static function loadPerson($name) {
        $db = new Datenbank();
        return $db->getPersonByName($name);
    }
}
?>

