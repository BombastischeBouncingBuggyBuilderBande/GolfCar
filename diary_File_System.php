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
        return new Person($personData['name'], $personData['password'], $personData['messageList']);
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

?>