<link rel="stylesheet" href="style_diary.css">
<script src="funktionen.js"></script>
<script>
    function login(){
        <?php
            //$person = FileManager::readPerson();
        ?>
    }

    function set(){

    }
</script>

    <div id="vertContainer">
        <div id="loginContainer">
            <label for="account-selector"></label>
            <select id="account-selector">
                <option value="admin">Admin</option>
                <option value="patrick">Patrick</option>
                <option value="pillip">Pillip</option>
                <option value="alex">Alex</option>
                <option value="rene">René</option>
            </select>
            <input type="text" placeholder="password" id="password">
            <button onclick="login()">Log In</button>
        </div>
        <div id="infoContainer">
            <?php
            /*
            require_once 'diary_Class.php';
            require_once 'diary_File_System.php';
            $fm = new FileManager();
            $person = new Person("Rene", "Websiteguy", "12345", [new Eintrag("05.02.2024", "rene", "website weiterentwickelt")]);
            echo $person->getName();
            echo "<br>";
            FileManager::savePerson($person);
            $person2 = FileManager::readPerson("Rene");
            echo $person2->getRolle();
            //$person2 = FileManager::readPerson("Rene");
            //echo $person2->getName();
            */
            ?>

            <div id=tb_uebersicht">
                <!-- Tabelle von Einträgen -->
            </div>
            <div id="tb_Funktionen">
                <!-- Eintrag hinzufügen -->
            </div>
        </div>
    </div>
