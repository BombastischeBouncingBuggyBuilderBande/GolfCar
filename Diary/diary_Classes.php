<?php

// FileManager Class ------------------------------------------------------------------------------------------------->
class FileManager
{
// __DIR__ . ...
    private static $directory = 'Diary_Eintraege/';

    public static function savePerson($person)
    {
        $filename = self::$directory . $person->getName() . '.json';

        $data = json_encode($person/*->toArray()*/);
        file_put_contents($filename, $data);
        echo "success";
    }

    public static function readPerson($name)
    {
        $filename = self::$directory . $name . '.json';
        if (!file_exists($filename)) {
            return null;
        }

        $data = file_get_contents($filename);
        $personData = json_decode($data, true);
        return new Person($personData['name'], $personData['rolle'], $personData['password'], $personData['messageList']);
    }

    public static function deletePerson($name)
    {
        $filename = self::$directory . $name . '.json';
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    public static function updatePerson(Person $person)
    {
        self::deletePerson($person->getName());
        self::savePerson($person);
    }
}
// Person Class ------------------------------------------------------------------------------------------------------>
class Person
{
    private $name;
    private $rolle;
    private $password;
    private $message_list;

    public function __construct($name, $rolle, $password, $message_list = [])
    {
        $this->message_list = $message_list;
        $this->name = $name;
        $this->password = $password;
        $this->rolle = $rolle;
    }

    public function addEintrag($datum, $beschreibung)
    {
        $this->message_list[0] = new Eintrag($datum, $this->name, $beschreibung);
        //FileManager::savePerson($this);
    }

    public function deleteEintrag($id)
    {
        for ($i = $id; $i <= (count($this->message_list)); $i++) {
            if ($i === $id) {
                $this->message_list[$i] = null;
                break;
            }
            $this->message_list[$i] = $this->message_list[$i + 1];
            FileManager::savePerson($this);

        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getRolle()
    {
        return $this->rolle;
    }

    public function getEntries(){
        return $this->message_list;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'rolle' => $this->rolle,
            'password' => $this->password,
            'messageList' => $this->message_list,
        ];
    }
    function generateHTMLTable()
    {
        $html = '<table border="1">';
        $html .= '<tr><th>Datum</th><th>Name</th><th>Beschreibung</th></tr>';

        foreach ($this->message_list as $eintrag) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($eintrag->getDatum()) . '</td>';
            $html .= '<td>' . htmlspecialchars($eintrag->getName()) . '</td>';
            $html .= '<td>' . htmlspecialchars($eintrag->getBeschreibung()) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }
    function sortTo($param)
    {
        usort($this->message_list, function($a, $b) use ($param) {
            if ($param == 'Datum') {
                $this->message_list = strcmp($a->getDatum(), $b->getDatum());
            } elseif ($param == 'name') {
                $this->message_list = strcmp($a->getName(), $b->getName());
            }
            // Default to sorting by Datum if an unknown parameter is provided
            $this->message_list = strcmp($a->getDatum(), $b->getDatum());
        });
    }


}
// Eintrag Class ----------------------------------------------------------------------------------------------------->
class Eintrag
{
    public $Datum;
    public $name;
    public $beschreibung;

    public function __construct($datum, $name, $beschreibung)
    {
        $this->beschreibung = $beschreibung;
        $this->Datum = strtotime($datum, "dd.mm-YYYY");
        $this->name = $name;
    }

    /**
     * @author René
     * @return mixed
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->Datum;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}

//beispiel
/*
$rne = new Person("rené Weissteiner", "Website");
$rne->addEintrag("03.03.2024", $rne->getName(), "tagebuch programmiert<br>");
$rne->addEintrag("03.03.2024", $rne->getName(), "Eintrag 2<br>");
$rne->addEintrag("03.03.2024", $rne->getName(), "Eintrag 34<br>");

echo $rne->message_list[0]->beschreibung;
echo $rne->message_list[1]->beschreibung;
echo $rne->message_list[2]->beschreibung;
$rne->deleteEintrag(0);
echo $rne->message_list[0]->beschreibung;
echo $rne->message_list[1]->beschreibung;
echo $rne->message_list[2]->beschreibung;
*/
?>
