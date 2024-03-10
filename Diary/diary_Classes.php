<?php

class FileManager
{
// __DIR__ . ...
    private static $directory = 'Diary_Eintraege/';

    public static function savePerson($person)
    {
        $filename = self::$directory . $person->getName() . '.json';

        $data = json_encode($person->toArray());
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

class Person
{
    private $name;
    private $rolle;
    private $password;

    public $message_list;

    public function __construct($name, $rolle, $password, $message_list = [])
    {
        $this->message_list = $message_list;
        $this->name = $name;
        $this->password = $password;
        $this->rolle = $rolle;
    }

    public function addEintrag($datum, $name, $beschreibung)
    {
        echo count($this->message_list);
        $this->message_list[count($this->message_list)] = new Eintrag($datum, $name, $beschreibung);
    }

    public function deleteEintrag($id)
    {
        for ($i = $id; $i <= (count($this->message_list)); $i++) {
            if ($i === $id) {
                $this->message_list[$i] = null;
                break;
            }
            $this->message_list[$i] = $this->message_list[$i + 1];

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

    public function toArray()
    {
        return [
            'name' => $this->name,
            'rolle' => $this->rolle,
            'password' => $this->password,
            'messageList' => $this->message_list,
        ];
    }

    public function loginChecker($password)
    {
        if ($this->password === $password) {
            return true;
        } else
            return false;
    }
}

class Eintrag
{
    public $Datum;
    public $name;
    public $beschreibung;

    public function __construct($datum, $name, $beschreibung)
    {
        $this->beschreibung = $beschreibung;
        $this->Datum = $datum;
        $this->name = $name;
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
