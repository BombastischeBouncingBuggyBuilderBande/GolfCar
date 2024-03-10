<?php
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Hier würden normalerweise die Login-Daten überprüft werden, z.B. mit einer Datenbank.
// Zur Demonstration wird hier ein einfacher Check durchgeführt:
echo "$username $password";
if ($username === 'admin' && $password === 'password') {
    echo "Erfolgreich eingeloggt!";
} else {
    echo "Ungültige Anmeldedaten.";
}
?>
