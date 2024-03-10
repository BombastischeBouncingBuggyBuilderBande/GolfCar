<?php
require "diary_Classes.php";
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Hier die Login-Daten überprüfen mit Datenbank.
if (FileManager::readPerson($username)->getPassword() === $password) {
    echo "true";
} else {
    echo "false";
}
?>
