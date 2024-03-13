<?php
class Eintrag {
    public $eintragID;
    public $name;
    public $beschreibung;
    public $arbeitsstunden;
    public $datum;

    public function __construct($eintragID = null, $name = null, $beschreibung = "abc", $arbeitsstunden = null, $datum = null) {
        $this->eintragID = $eintragID;
        $this->name = $name;
        $this->beschreibung = $beschreibung;
        $this->arbeitsstunden = $arbeitsstunden;
        $this->datum = $datum;
    }

    // Zeigt alle Einträge einer Person
    public static function zeigeEintraege($name) {
        $db = new Datenbank();
        $eintraege = $db->getEintraegeByPerson($name);

        echo "<pre>";
        print_r($eintraege);
        echo "</pre>";

        /*
        foreach ($eintraege as $eintrag) {
            foreach($eintrag as $key => $value){

            }
            //echo $key . ":" . $eintrag[$key];
           // echo $eintrag->datum . ": " . $eintrag->beschreibung . " (" . $eintrag->arbeitsstunden . " Stunden)<br>";
        }
        */
    }
}
?>

