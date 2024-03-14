<?php
require "Classes/Datenbank.php";
echo "heyho";
$eintragID = isset($_POST['IDEintragDeleteText']) ? $_POST['IDEintragDeleteText'] : '20';
$db = new Datenbank();
$db->deleteEintrag("20");
echo (int)$eintragID;
?>