<link rel="stylesheet" href="Diary/style_diary.css"> <!-- because diary is included in index.php it searches from there-->
<script src="../funktionen.js"></script>
<script src="Diary/functions_diary.js"></script>

    <div id="vertContainer">
        <form id="loginForm">
            <label for="account-selector"></label>
            <select id="account-selector" name="username" required>
                <option value="admin">Admin</option>
                <option value="patrick">Patrick</option>
                <option value="pillip">Pillip</option>
                <option value="alex">Alex</option>
                <option value="rene">René</option>
            </select>
            <label for="password"><input name="password" type="text" placeholder="password" id="password" required></label>
            <button type="submit">Log In</button>
            <div id="loginResult"></div>
        </form>
    </div>
