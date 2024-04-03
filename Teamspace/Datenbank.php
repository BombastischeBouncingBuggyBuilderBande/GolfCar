    <?php
    /**
     * Datenbankverwaltung für das Tagebuch.
     *
     * @author René
     */
    class Datenbank {
        private $host = 'baller';
        private $db   = 'Tagebuch';

        private $user = 'root';
        private $pass = 'pegging';
        private $charset = 'utf8mb4';
        private $pdo;

        /**
         * Konstruktor, stellt eine Verbindung zur Datenbank her.
         */
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

        /**
         * Fügt eine neue Person hinzu oder aktualisiert sie.
         *
         * @param string $oldName Der alte Name der Person.
         * @param string $name Der neue Name der Person.
         * @param string $rolle Die Rolle der Person.
         * @param string $passwort Das Passwort der Person.
         */
        public function updatePerson($oldName, $name, $rolle, $passwort) {
            $sql = "INSERT INTO Person (name, rolle, passwort) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rolle = ?, passwort = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $rolle, $passwort, $rolle, $passwort]);
        }

        /**
         * Lädt eine Person anhand des Namens.
         *
         * @param string $name Der Name der Person.
         * @return array|null Die Daten der Person oder null, falls nicht gefunden.
         */
        public function getPersonByName($name) {
            $sql = "SELECT * FROM Person WHERE name = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name]);
            return $stmt->fetch();
        }

        /**
         * Lädt alle Einträge einer bestimmten Person.
         *
         * @param string $name Der Name der Person.
         * @return array Die Einträge der Person.
         */
        public function getEintraegeByPerson($name) {

            if($name !== "admin") {
                $sql = "SELECT * FROM Eintrag WHERE Name = ? ORDER BY Datum DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$name]);
            }else{
                $sql = "SELECT * FROM Eintrag ORDER BY Datum DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(); // Keine Parameter erforderlich, da wir keine spezifischen Einträge filtern

            }
            return $stmt->fetchAll();
        }

        /**
         * Fügt einen neuen Tagebucheintrag hinzu.
         *
         * @param string $name Der Name der Person.
         * @param string $beschreibung Die Beschreibung des Eintrags.
         * @param int $arbeitsstunden Die Arbeitsstunden.
         * @param string $datum Das Datum des Eintrags.
         */
        public function addEintrag($name, $beschreibung, $arbeitsstunden, $datum) {
            $sql = "INSERT INTO Eintrag (Name, beschreibung, arbeitsstunden, Datum) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $beschreibung, $arbeitsstunden, $datum]);
        }

        /**
         * Fügt eine neue Person hinzu.
         *
         * @param string $name Der Name der Person.
         * @param string $rolle Die Rolle der Person.
         * @param string $passwort Das Passwort der Person.
         */
        public function addPerson($name, $rolle, $passwort) {
            $sql = "INSERT INTO Person (name, rolle, passwort) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $rolle, $passwort]);
        }

        /**
         * Fügt eine neue Person hinzu, wenn sie noch nicht existiert.
         *
         * @param string $personName Der Name der Person.
         * @param string $rolle Die Rolle der Person.
         * @param string $passwort Das Passwort der Person.
         * @return bool True, wenn hinzugefügt, false, wenn schon existiert.
         */
        public function addPerson_ifNotExist($personName, $rolle, $passwort)
        {
            $existierendePerson = $this->getPersonByName($personName);
            if (!$existierendePerson) {
                // Person nicht gefunden, erstelle Person
                $this::addPerson($personName, $rolle, $passwort);
                return true;
            } else {
                // Person existiert bereits
                return false;
            }
        }
        /**
         * Holt einen Eintrag aus der Datenbank anhand seiner EintragID.
         *
         * @param int $eintragId Die ID des Eintrags, der abgerufen werden soll.
         *
         * @return array|null Das assoziative Array, das den Eintrag darstellt, oder null, wenn kein Eintrag gefunden wurde.
         */
        public function getEintragByID($eintragId)
        {
            // Stellt sicher, dass PDO Fehler als Exceptions wirft
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL-Query vorbereiten
            $query = "SELECT * FROM Eintrag WHERE EintragID = :eintragId";

            try {
                // Prepared Statement vorbereiten
                $stmt = $this->pdo->prepare($query);

                // Parameter binden
                $stmt->bindParam(':eintragId', $eintragId, PDO::PARAM_INT);

                // Query ausführen
                $stmt->execute();

                // Ein Ergebnis abrufen
                $eintrag = $stmt->fetch(PDO::FETCH_ASSOC);

                // Überprüfen, ob ein Eintrag gefunden wurde
                if ($eintrag) {
                    return $eintrag;
                } else {
                    // Kein Eintrag gefunden
                    return null;
                }
            } catch (PDOException $e) {
                // Fehlerbehandlung
                echo "Ein Fehler ist aufgetreten beim Abrufen des Eintrags: " . $e->getMessage();
                return null;
            }
        }

        /**
         * Funktion zum Bearbeiten eines Eintrags in der Datenbank.
         *
         * @param int $eintragId Die ID des zu bearbeitenden Eintrags
         * @param int $arbeitsstunden Die Arbeitsstunden
         * @param string $datum Das Datum im Format 'YYYY-MM-DD'
         * @param string $beschreibung Die Beschreibung
         *
         * @return bool Gibt true zurück, wenn das Update erfolgreich war, sonst false
         */
        function editEintrag($eintragId, $arbeitsstunden = null, $datum = null, $beschreibung = null)
        {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE Eintrag SET arbeitsstunden = :arbeitsstunden, Datum = :datum, beschreibung = :beschreibung WHERE EintragID = :eintragId";

            $oldParams = $this->getEintragByID($eintragId);
            try {
                $stmt = $this->pdo->prepare($query);
                if($arbeitsstunden != null) {
                    $stmt->bindParam(':arbeitsstunden', $arbeitsstunden, PDO::PARAM_INT);
                }else{
                    $stmt->bindParam(':arbeitsstunden', $oldParams['arbeitsstunden']);
                }
                if($datum != null) {
                    $stmt->bindParam(':datum', $datum);
                }else{
                    $stmt->bindParam(':datum', $oldParams['Datum']);
                }
                if($beschreibung != null) {
                    $stmt->bindParam(':beschreibung', $beschreibung);
                }else{
                    $stmt->bindParam(':beschreibung', $oldParams['beschreibung']);
                }
                $stmt->bindParam(':eintragId', $eintragId, PDO::PARAM_INT);

                return $stmt->execute();
            } catch (PDOException $e) {
                // Fehlerbehandlung
                echo "Ein Fehler ist aufgetreten: " . $e->getMessage();
                return false;
            }
        }

        /**
         * Funktion zum Bearbeiten einer Person in der Datenbank.
         *
         * @param string $name Der Name der Person, die bearbeitet werden soll
         * @param string $neueRolle Die neue Rolle der Person
         * @param string $neuesPasswort Das neue Passwort der Person
         *
         * @return bool Gibt true zurück, wenn das Update erfolgreich war, sonst false
         */
        function editPerson($name, $neueRolle = null, $neuesPasswort = null)
        {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE Person SET rolle = :neueRolle, passwort = :neuesPasswort WHERE name = :name";

            $oldParams = $this->getPersonByName($name);
            try {
                $stmt = $this->pdo->prepare($query);
                if($neueRolle != null) {
                    $stmt->bindParam(':neueRolle', $neueRolle);
                }else{
                    $stmt->bindParam(':neueRolle', $oldParams['rolle']);
                }
                if($neuesPasswort != null) {
                    $stmt->bindParam(':neuesPasswort', $neuesPasswort);
                }else{
                    $stmt->bindParam(':neuesPasswort', $oldParams['passwort']);
                }
                $stmt->bindParam(':name', $name);

                return $stmt->execute();
            } catch (PDOException $e) {
                // Fehlerbehandlung
                echo "Ein Fehler ist aufgetreten: " . $e->getMessage();
                return false;
            }
        }

        /**
         * Löscht eine Person anhand des Namens.
         *
         * @param string $name Der Name der Person.
         */
        public function deletePerson($name) {
            $sql = "DELETE FROM Person WHERE name = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name]);
        }

        /**
         * Löscht einen Eintrag anhand der EintragID.
         *
         * @param int $eintragID Die ID des Eintrags.
         */
        public function deleteEintrag($eintragID) {
            $sql = "DELETE FROM Eintrag WHERE EintragID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$eintragID]);
        }
    }