<?php

require "diary_Classes.php";
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
?>
<div id='diary-table'>
    <?php
    FileManager::readPerson($username)->sortTo("Datum");
    FileManager::readPerson($username)->generateHTMLTable();
    ?>
</div>
<div id='diary-functions'>
</div>