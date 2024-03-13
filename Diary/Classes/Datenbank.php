<?php
class Datenbank {
    private $host = 'localhost';
    private $db   = 'Tagebuch';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Fügt eine neue Person hinzu oder aktualisiert sie, wenn sie bereits existiert
    public function updatePerson($oldName, $name, $rolle, $passwort) {
        $sql = "INSERT INTO Person (name, rolle, passwort) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rolle = ?, passwort = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $rolle, $passwort, $rolle, $passwort]);
    }

    // Lädt eine Person anhand des Namens
    public function getPersonByName($name) {
        $sql = "SELECT * FROM Person WHERE name = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name]);
        return $stmt->fetch();
    }

    // Lädt alle Eintrag einer bestimmten Person
    public function getEintraegeByPerson($name) {
        $sql = "SELECT * FROM Eintrag WHERE Name = ? ORDER BY Datum DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name]);
        //return $stmt->fetchAll(PDO::FETCH_CLASS, "Eintrag");
        return $stmt->fetchAll();
    }
    // Fügt einen neuen Tagebucheintrag hinzu
    public function addEintrag($name, $beschreibung, $arbeitsstunden, $datum) {
        $sql = "INSERT INTO Eintrag (Name, beschreibung, arbeitsstunden, Datum) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $beschreibung, $arbeitsstunden, $datum]);
    }
    // Fügt eine neue Person hinzu
    public function addPerson($name, $rolle, $passwort) {
        $sql = "INSERT INTO Person (name, rolle, passwort) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $rolle, $passwort]);
    }

    public function addPerson_ifNotExist($personName, $rolle, $passwort){
        $existierendePerson = Person::loadPerson($personName);
        if (!$existierendePerson) {
            // Person nicht gefunden, erstelle Person
            $this::addPerson($personName, $rolle, $passwort);
            return true;
        } else {
            // Person existiert bereits
            return false;
        }
}

}

?>

