<?php

?>
    <script src="Diary/functions_diary.js"></script>
    <form id="deleteEintragForm">
        <label for="EintragsID"><input name="IDEintragDeleteText" type="text" placeholder="ID des Eintrags" id="EintragsID" required></label>
        <button type="submit">Delete</button>
        <div id="loginResult"></div>
    </form>
<?php
/*
require ".php";
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
*/
?>